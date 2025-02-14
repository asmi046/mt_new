<template>

<svg v-show="loader" class="loader_icon pay_loader_icon">
    <use xlink:href="#loader"></use>
</svg>

<h3 v-show="enpty_pay_data" class="empty_data">Платеж с данными реквизитами не найден</h3>

<div v-show="!loader && !enpty_pay_data" class="pay_box_wrapper">
    <div class="box pay_box">
        <div class="img_wrapper">
            <img :src="pay_data.img" :alt="pay_data.name">
        </div>

        <div class="text_wrapper">
            <h2> {{ pay_data.name }} </h2>

            <div class="main_label">
                <span>Сумма: {{ pay_data.price }}</span>
                <div class="icon">
                    <svg class="svg_icon">
                        <use xlink:href="#ruble"></use>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <form class="client_form" action="">
        <div class="box client_box">
            <h2>Контакты</h2>

            <div class="field">
                <label for="c_phone">Телефон<sup>*</sup></label>
                <input v-model="client_data.phone" name="phone" :class="{_error: client_error_field.phone}" type="c_phone" v-mask="{mask: 'N (NNN) NNN-NN-NN', model: 'cpf' }" placeholder="_(___)___-__-__">
            </div>


            <div class="field">
                <label for="c_email">E-mail</label>
                <input v-model="client_data.email" id="c_email" type="mail" placeholder="info@mail.ru">
            </div>
        </div>

        <div class="box client_box">
            <h2>Данные пассажира</h2>

                <div class="field">
                    <label for="c_fio">ФИО клиента<sup>*</sup></label>
                    <input v-model="client_data.fio" name="name" :class="{_error: client_error_field.fio}" id="c_fio" type="text" placeholder="Иванов Иван Иванович">
                </div>

                <div class="field">
                    <label for="c_dr">Дата рождения<sup>*</sup></label>
                    <input v-model="client_data.dr" :class="{_error: client_error_field.dr}" id="c_dr" type="text" placeholder="__.__.____">
                </div>


                <div class="field">
                    <label for="c_type">Тип документа<sup>*</sup></label>
                    <select  v-model="client_data.document_type" id="c_type">
                        <option value="Паспорт">Паспорт</option>
                        <option value="Свидетельство о рождении">Свидетельство о рождении</option>
                    </select>
                </div>


                <div v-if="client_data.document_type == 'Паспорт'" class="field">
                    <label for="c_number">Серия и № паспорта<sup>*</sup></label>
                    <input  v-model="client_data.document_number" :class="{_error: client_error_field.number}" id="c_number" type="text" v-mask="{mask: 'NNNN NNNNNN', model: 'cpf' }" placeholder="____ ______">
                </div>

                <div v-else class="field">
                    <label for="c_number">№ свидетельства<sup>*</sup></label>
                    <input  v-model="client_data.document_number" :class="{_error: client_error_field.number}" id="c_number" type="text" placeholder="__-__№______">
                </div>
        </div>

        <label for="f_policy" class="policy_label">
            <input required checked type="checkbox" name="policy" id="f_policy" class="_req">
            <span>Я даю свое <a href="https://www.mirturizma46.ru/soglasie-na-obrabotku-personalnyx-dannyx/">согласие на обработку персональных данных</a> а так же соглашаюсь с <a href="https://www.mirturizma46.ru/politika-v-oblasti-obrabotki-personalnyx-dannyx-polzovatelej/">политикой конфиденциальности</a></span>
        </label>
        <br>
        <button @click.prevent="to_pay_lnk">Оплатить</button>

    </form>
</div>

</template>

<script setup>
    import { reactive, ref, watch } from 'vue';

    const props = defineProps({
        uuid: String
    })

    let pay_data = ref({})

    let loader = ref(false)
    let enpty_pay_data = ref(false)


    let client_data = reactive({
        fio: '',
        phone: '',
        email: '',
        dr: '',
        document_type: 'Паспорт',
        document_number: ''
    })

    let client_error_field = reactive({
        fio: false,
        phone: false,
        dr: false,
        document_number: false
    })


    watch(() => client_data.document_type, (value) => {
        client_data.document_number = ''
    })


    const getPayData = async () => {
        loader.value = true
        await axios.get('/pay/get_active_pay_data/'+props.uuid)
        .then((response) => {
            pay_data.value = response.data
        })
        .catch( (error) => {
            console.log(error)
            enpty_pay_data.value = true;
        });
        loader.value = false
    }

    const to_pay_lnk = async () => {
        client_error_field.fio = false
        client_error_field.phone = false
        client_error_field.document_number = false


        let error = false
        if(client_data.fio == '') {
            client_error_field.fio = true
            error = true
        }

        if(client_data.phone == '') {
            client_error_field.phone = true
            error = true
        }

        if(client_data.document_number == '') {
            client_error_field.document_number = true
            error = true
        }

        if(error) {
            return
        }

        loader.value = true
        await axios.get('/pay/get_pay_lnk', {
            params: {
                uuid: props.uuid,
                phone: client_data.phone,
                email: client_data.email,
                clients : [
                    {
                        fio: client_data.fio,
                        dr: client_data.dr,
                        document_type: client_data.document_type,
                        document_number: client_data.document_number
                    },
                ]

            }
        })
        .then((response) => {
            console.log(response.data)
            document.location.href = response.data.payment_url
        })
        .catch( (error) => {
            console.log(error)
            loader.value = false
        });

    }

    getPayData()
</script>
