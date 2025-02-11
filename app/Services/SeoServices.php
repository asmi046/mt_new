<?php
namespace App\Services;

use App\Models\SeoData;
use Illuminate\Support\Str;


class SeoServices {

    public $seo_data;

    public function __construct()
    {
        $this->seo_data = $this->get_data_by_url();
    }

    public function __toString() {

        $seo_title = $this->seo_data?$this->seo_data->seo_title:config('asmiseo.default_seo_title');
        $seo_title .= config('asmiseo.concat_title_postfix')?" - ".config('asmiseo.title_postfix'):"";
        $seo_description = $this->seo_data?$this->seo_data->seo_description:config('asmiseo.default_seo_description');

        $result = "<title>".$seo_title."</title>"."\n\r";
        $result .= '<meta name="description" content="'.$seo_description.'">'."\n\r";
        $result .= '<meta property="og:locale" content="ru_RU" />'."\n\r";
        $result .= '<meta property="og:type" content="website" />'."\n\r";
        $result .= '<meta property="og:title" content="'.$seo_title.'" />'."\n\r";
        $result .= '<meta property="og:description" content="'.$seo_description.'" />'."\n\r";
        $result .= '<meta property="og:url" content="'.\Request::url().'" />'."\n\r";
        $result .= '<meta property="og:site_name" content="'. config('asmiseo.title_postfix') .'" />'."\n\r";
        $result .= '<meta property="og:image" content="'.asset('img/og_img.jpg').'" />'."\n\r";
        $result .= '<meta property="og:image:type" content="image/jpeg" />'."\n\r";
        $result .= '<meta name="twitter:card" content="summary_large_image" />'."\n\r";

        return $result;
    }

    public function get_data_by_url() {
        $url = \Request::path();
        $url_data = cache()->rememberForever(
            "seo_".Str::slug($url),
            function() {
                $url = \Request::path();
                return SeoData::where('url', $url)->first();
            }
        );

        return $url_data;
    }

}
