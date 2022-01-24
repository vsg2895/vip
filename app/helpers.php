<?php

use App\FilterInput;
use App\SparePartsStore;
use Illuminate\Http\Request;
use App\Translation;
use App\Currency;
use App\PostOption;
use App\Post;
use App\Category;
use App\UserRating;
use App\SiteData;
use App\Wallet;

// letter multilanguage values
class Search_Multilang
{
    public $search_word;


    public $array_world = [];

    public function __construct($search_word, $array_world)
    {
        $this->search_word = $search_word;
        $this->array_world = $array_world;
    }

    public function isRussian($text)
    {
        return !preg_match('/[^А-Яа-яЁё]/u', $text);
    }

    public function isEnglish($string)
    {
        return !preg_match('/[^A-Za-z0-9]/', $string);
    }

    public function current_language()
    {
        $res = ($this->isRussian($this->search_word) ? 'ru' : ($this->isEnglish($this->search_word) ? 'en' : 'hy'));

//        $res = ($this->isRussian(preg_replace("/[^a-zA-Z0-9\s]/", "", $this->search_word)) ? 'ru' : ($this->isEnglish(preg_replace("/[^a-zA-Z0-9]/", "", $this->search_word)) ? 'en' : 'hy'));
        //        $res = ($this->isRussian(trim ($this->search_word , $characters = "\n\r\t\v\0" )) ? 'ru' : ($this->isEnglish(trim ($this->search_word , $characters = "\n\r\t\v\0" )) ? 'en' : 'hy'));
        return $res;
    }

//    public function add_searched_words($lang, $array_replaced)
//    {
//        $array_returned = [];
//        array_push($array_returned, $this->search_word);
//        if ($lang != 'hy') {
//            foreach ($array_replaced as $key => $el) {
//                if ($key != $lang && $key != $lang . '2') {
////                    if (array_key_exists($key, $array_returned)) {
//                        array_push($array_returned, str_replace($array_replaced[$lang], $el, $this->search_word));
////                    }
//                }
//            }
//        }
//////        $this->search_word = str_replace(" ","-",$this->search_word);
////        $array_returned = [];
////        array_push($array_returned, $this->search_word);
////        if ($lang != 'hy') {
////            foreach ($array_replaced as $key => $el) {
////                if ($key != $lang) {
////                    array_push($array_returned, str_replace($array_replaced[$lang], $el, $this->search_word));
////                }
////            }
////        } else {
////            $array_arm_keys = [];
////            for ($i = 1; $i < 5; $i++) {
////                array_push($array_arm_keys, 'hy' . $i);
////            }
//////            foreach ($array_replaced as $key => $el) {
////
////            foreach ($array_replaced as $key2 => $el2) {
////                if (!in_array($key2, $array_arm_keys)) {
////                    foreach ($array_arm_keys as $val) {
////                        $word = str_replace($array_replaced[$val], $el2, $this->search_word);
//////                        if ($this->isRussian($word) || $this->isEnglish($word)) {
////                        array_push($array_returned, $word . " " . $key2);
//////                        }
////
////                    }
////                }
////            }
//////            }
////        }
////        $array_returned = array_unique($array_returned);
//        return $array_returned;
//    }

//    rus spacing simbols 'Љ', 'Њ', 'Џ', 'џ', 'ш', 'ђ', 'ч', 'ћ', 'ж', 'љ', 'њ', 'Ш', 'Ђ', 'Ч', 'Ћ', 'Ж','Ц','ц',
//    eng spacing simbols 'Lj', 'Nj', 'Dž', 'dž', 'š', 'đ', 'č', 'ć', 'ž', 'lj', 'nj', 'Š', 'Đ', 'Č', 'Ć', 'Ž','C','c',,
    public function create_search_words()
    {
//        $textcyr = $this->search_word;
//        $textlat = "rana";


        $arm = [' ', 'ա', 'բ', 'գ', 'դ', 'ե', 'զ', 'է', 'ը', 'թ', 'ժ', 'ի', 'լ', 'խ', 'ծ', 'կ', 'հ', 'ձ', 'ղ', 'ճ', 'մ', 'յ', 'ն', 'շ', 'ո', 'չ', 'պ', 'ջ', 'ռ', 'ս', 'վ', 'տ', 'ր', 'ց', 'ու', 'փ', 'ք', 'և', 'օ', 'ֆ', 'յու'
        ];
        $rus = [' ', 'а', 'б', 'г', 'д', 'е', 'з', 'э', 'ъ', 'т', 'ж', 'и', 'л', 'х', 'ть', 'к', 'х', 'дз', 'х', 'ч', 'м', 'й', 'н', 'ш', 'о', 'ч', 'п', 'дж', 'р', 'с', 'в', 'т', 'р', 'ц', 'у', 'п', 'к', 'ев', 'о', 'ф', 'ю'
        ];
        $rus2 = [' ', 'а', 'б', 'г', 'д', 'ё', 'з', 'е', 'ъ', 'т', 'ж', 'и', 'л', 'х', 'ц', 'к', 'х', 'дз', 'х', 'чь', 'м', 'я', 'н', 'щ', 'о', 'ч', 'п', 'ж', 'р', 'с', 'в', 'т', 'рь', 'ц', 'у', 'п', 'кь', 'ев', 'о', 'ф', 'ю'
        ];
        $eng = [' ', 'a', 'b', 'g', 'd', 'e', 'z', 'e', 'y', 't', 'zh', 'i', 'l', 'x', 'ts', 'k', 'h', 'dz', 'x', 'j', 'm', 'y', 'n', 'sh', 'o', 'ch', 'p', 'j', 'r', 's', 'v', 't', 'r', 'c', 'u', 'p', 'q', 'ev', 'o', 'f', 'yu'
        ];
        $eng2 = [' ', 'a', 'b', 'g', 'd', 'e', 'z', 'e', 'y', 't', 'jh', 'e', 'l', 'kh', 'tc', 'c', 'h', 'z', 'x', 'jh', 'm', 'y', 'n', 's', 'o', 'c', 'p', 'dj', 'r', 'c', 'v', 't', 'r', 'c', 'u', 'p', 'c', 'ev', 'o', 'f', 'yu'
        ];
//        dump(count($arm));
//        dump(count($rus));
//        dump(count($rus2));
//        dump(count($eng));
//        dump(count($eng2));
//        $rus = [' ', 'в', 'х', 'а', 'б', 'в', 'г', 'с', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я'
//        ];
//        $arm1 = [' ', 'վ', 'ղ', 'ա', 'բ', 'վ', 'գ', 'ս', 'դ', 'ե', 'յո', 'ժ', 'զ', 'ի', 'իյ', 'կ', 'լ', 'մ', 'ն', 'օ', 'պ', 'ռ', 'ս', 'տ', 'ու', 'ֆ', 'խ', 'ց', 'չ', 'շ', 'շ', 'ը', 'ի', '', 'է', 'յու', 'յա', 'Ա', 'Բ', 'Վ', 'Գ', 'Դ', 'Ե', 'ՅՈ', 'Ժ', 'Զ', 'Ի', 'ԻՅ', 'Կ', 'Լ', 'Մ', 'Ն', 'Օ', 'Պ', 'Ռ', 'Ս', 'Տ', 'ՈՒ', 'Ֆ', 'Խ', 'Ց', 'Չ', 'Շ', 'Շ', '', 'Ի', '', 'Է', 'ՅՈՒ', 'ՅԱ',
//        ];
//        $arm2 = [' ', 'վ', 'խ', 'ա', 'բ', 'վ', 'գ', 'ս', 'դ', 'ե', 'եո', 'ժ', 'զ', 'ի', 'ի', 'կ', 'լ', 'մ', 'ն', 'ո', 'փ', 'ր', 'ս', 'տ', 'ու', 'ֆ', 'ղ', 'ծ', 'ճ', 'շ', 'շհ', 'ը', 'ի', '', 'ե', 'յու', 'յա', 'Ա', 'Բ', 'Վ', 'Գ', 'Դ', 'Ե', 'ԵՈ', 'Ժ', 'Զ', 'Ի', 'Ի', 'Կ', 'Լ', 'Մ', 'Ն', 'Ո', 'Պ', 'Ր', 'Ս', 'Տ', 'ՈՒ', 'Ֆ', 'Ղ', 'Ծ', 'Չ', 'Շ', 'ՇՀ', '', 'Ի', '', 'Ե', 'ՅՈՒ', 'ՅԱ',
//        ];
//        $arm1_3 = [' ', 'վ', 'ղ', 'ա', 'բ', 'վ', 'գ', 'ս', 'դ', 'ե', 'յո', 'ժ', 'զ', 'ի', 'իյ', 'կ', 'լ', 'մ', 'ն', 'օ', 'պ', 'ռ', 'ս', 'տ', 'ու', 'ֆ', 'հ', 'ց', 'չ', 'շ', 'շ', 'ը', 'ի', '', 'է', 'յու', 'յա', 'Ա', 'Բ', 'Վ', 'Գ', 'Դ', 'Ե', 'ՅՈ', 'Ժ', 'Զ', 'Ի', 'ԻՅ', 'Կ', 'Լ', 'Մ', 'Ն', 'Օ', 'Պ', 'Ռ', 'Ս', 'Տ', 'ՈՒ', 'Ֆ', 'Հ', 'Ց', 'Չ', 'Շ', 'Շ', '', 'Ի', '', 'Է', 'ՅՈՒ', 'ՅԱ',
//        ];
//        $arm2_3 = [' ', 'վ', 'խ', 'ա', 'բ', 'վ', 'գ', 'ք', 'դ', 'ե', 'եո', 'ժ', 'զ', 'ի', 'ի', 'կ', 'լ', 'մ', 'ն', 'ո', 'փ', 'ր', 'ս', 'տ', 'ու', 'ֆ', 'հ', 'ծ', 'ճ', 'շ', 'շհ', 'ը', 'ի', '', 'ե', 'յու', 'յա', 'Ա', 'Բ', 'Վ', 'Գ', 'Դ', 'Ե', 'ԵՈ', 'Ժ', 'Զ', 'Ի', 'Ի', 'Կ', 'Լ', 'Մ', 'Ն', 'Ո', 'Պ', 'Ր', 'Ս', 'Տ', 'ՈՒ', 'Ֆ', 'Հ', 'Ծ', 'Չ', 'Շ', 'ՇՀ', '', 'Ի', '', 'Ե', 'ՅՈՒ', 'ՅԱ',
//        ];
//        $arm3 = [' ', 'վե', 'հ', 'ա', 'բ', 'վ', 'գ', 'ս', 'դ', 'ե', 'եո', 'ժ', 'զ', 'ի', '', 'ք', 'լ', 'մ', 'ն', 'ո', 'փ', 'ր', 'ս', 'թ', 'ու', 'ֆ', 'հ', 'ձ', 'ճ', 'շ', 'շհ', 'ը', 'ի', '', 'ե', 'յու', 'յա', 'Ա', 'Բ', 'Վ', 'Գ', 'Դ', 'Ե', 'ԵՈ', 'Ժ', 'Զ', 'Ի', '', 'Կ', 'Լ', 'Մ', 'Ն', 'Ո', 'Պ', 'Ր', 'Ս', 'Տ', 'ՈՒ', 'Ֆ', 'Հ', 'Ծ', 'Չ', 'Շ', 'ՇՀ', '', 'Ի', '', 'Ե', 'ՅՈՒ', 'ՅԱ',
//        ];
//        $eng = [' ', 'w', 'x', 'a', 'b', 'v', 'g', 'c', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sht', 'y', 'i', 'y', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
//        ];
//        $eng2 = [' ', 'w', 'x', 'a', 'b', 'v', 'g', 's', 'd', 'e', 'io', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'ts', 'ch', 'sh', 'sh', 'a', 'i', 'y', 'e', 'yu', 'ya', 'A', 'B', 'V', 'G', 'D', 'E', 'Io', 'Zh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'Ts', 'Ch', 'Sh', 'Sht', 'A', 'I', 'Y', 'e', 'Yu', 'Ya'
//        ];
//        $array_variants = ['ru' => $rus, 'ru2' => $rus, 'en' => $eng, 'en2' => $eng2, 'hy' => $arm];
//        array_push($this->array_world, $this->search_word);
//        $textcyr = str_replace($rus, $eng, $textcyr);
//        $textlat = str_replace($eng, $rus, $textlat);
//        echo("$textcyr $textlat");
        $lang = $this->current_language();
        dump($lang);
        switch ($lang) {
            case "ru":
                $text1 = str_replace($rus, $eng, $this->search_word);
                $text2 = str_replace($rus, $eng2, $this->search_word);
                $text3 = str_replace($rus, $arm, $this->search_word);
                $text4 = str_replace($rus2, $eng, $this->search_word);
                $text5 = str_replace($rus2, $eng2, $this->search_word);
                $text6 = str_replace($rus2, $arm, $this->search_word);
//                $text7 = str_replace($rus, $arm3, $this->search_word);
                $this->array_world = [$this->search_word, $text1, $text2, $text3, $text4, $text5, $text6];
                $this->array_world = array_unique($this->array_world);
                dd($this->array_world);
                break;
            case "en":
                $text1 = str_replace($eng, $rus, $this->search_word);
                $text2 = str_replace($eng, $rus2, $this->search_word);
                $text3 = str_replace($eng, $arm, $this->search_word);
                $text4 = str_replace($eng2, $rus, $this->search_word);
                $text5 = str_replace($eng2, $rus2, $this->search_word);
                $text6 = str_replace($eng2, $arm, $this->search_word);
//                $text8 = str_replace($eng2, $rus, $this->search_word);
//                $text9 = str_replace($eng2, $arm1, $this->search_word);
//                $text10 = str_replace($eng2, $arm2, $this->search_word);
//                $text11 = str_replace($eng2, $arm1_3, $this->search_word);
//                $text12 = str_replace($eng2, $arm2_3, $this->search_word);
//                $text13 = str_replace($eng2, $arm3, $this->search_word);
                $this->array_world = [$this->search_word, $text1, $text2, $text3, $text4, $text5, $text6];
                $this->array_world = array_unique($this->array_world);
//                $this->array_world = $this->add_searched_words($lang, $array_variants);
                dd($this->array_world);
//                echo "Your language is en";
                break;
            case "hy":
                $text1 = str_replace($arm, $rus, $this->search_word);
                $text2 = str_replace($arm, $rus2, $this->search_word);
                $text3 = str_replace($arm, $eng, $this->search_word);
                $text4 = str_replace($arm, $eng2, $this->search_word);
//                $text5 = str_replace($arm2, $eng, $this->search_word);
//                $text6 = str_replace($arm2, $eng2, $this->search_word);
//                $text7 = str_replace($arm3, $rus, $this->search_word);
//                $text8 = str_replace($arm3, $eng, $this->search_word);
//                $text9 = str_replace($arm3, $eng2, $this->search_word);
//                $text10 = str_replace($arm1_3, $rus, $this->search_word);
//                $text11 = str_replace($arm1_3, $eng, $this->search_word);
//                $text12 = str_replace($arm1_3, $eng2, $this->search_word);
//                $text13 = str_replace($arm2_3, $rus, $this->search_word);
//                $text14 = str_replace($arm2_3, $eng, $this->search_word);
//                $text15 = str_replace($arm2_3, $eng2, $this->search_word);
                $this->array_world = [$this->search_word, $text1, $text2, $text3, $text4];
                $this->array_world = array_unique($this->array_world);
//                $this->array_world = $this->add_searched_words($lang, $array_variants);
                dd($this->array_world);
//                echo "Your language is hy";
                break;
            default:
                echo "Your language is nothing";
        }
//  Loop in search value each letter
//        dump($this->search_word)

//        dump($this->search_word[0]);
////        $formattedString = mb_strtolower($this->search_word[0]);
////        $utf_currect_word = iconv('UTF-8', 'utf-8//TRANSLIT', $formattedString);
//        dump(mb_check_encoding($this->search_word[0]));
//        dump(mb_detect_encoding($this->search_word[0]));

//        if ($this->isRussian($this->search_word) == true)
//        {
//        dump($this->isRussian($this->search_word), 'rus');
//        }
//        if ($this->isEnglish($this->search_word) == true)
//        {
//        dump($this->isEnglish($this->search_word), 'eng');
//        }

//        $word = iconv(mb_detect_encoding($this->search_word[0], mb_detect_order(), true), "UTF-8", $this->search_word[0]);
////        dump(mb_convert_encoding($this->search_word[0]));
////        dump(strlen($word));
//        dump($word[0]);
//        if ('р' == $word)
//        {
//            dd('haaaa');
//        }

//        for ($i = 0; $i < strlen($this->search_word); $i++) {
//
////            dump(preg_match('/[А-Яа-яЁё]/u', $this->search_word[$i]));
////            $word_by = mb_convert_encoding($this->search_word[$i], "UTF-8");
////            $dos = mb_convert_encoding($this->search_word[$i], "CP850", mb_detect_encoding($this->search_word[$i], "UTF-8, CP850, ISO-8859-15", true));
////            dump($word[$i]);
////   Loop multilanguage array
//
//            foreach ($this->array_lang as $item) {
//// Check if letter + next letter index not undefined and check letter and letter + next combinate example "s" & "sh"
//                if ($i < (strlen($this->search_word) - 1)) {
//                    $two_word = $this->search_word[$i] . $this->search_word[$i + 1];
//
//                } else {
//                    $two_word = $this->search_word[$i];
//
//                }
//// Check if letter or letters combinate exists in current multilanguage item push item in our word array without search value letter
//                if (in_array($this->search_word[$i], $item) || in_array($two_word, $item)) {
//                    $key_el = "";
//                    foreach ($item as $key => $el) {
//                        if ($el == $this->search_word[$i] || $el == $two_word) {
//                            $key_el = $el;
//                            unset($item[$key]);
//
//                        }
//
//                    }
//                    $this->array_world[$key_el][] = $item;
////               array_push($this->array_world,$item);
//                } else {
//                    foreach ($item as $k => $elem) {
//                        if (is_array($elem)) {
//
//                            if (in_array($this->search_word[$i], $elem) || in_array($two_word, $elem)) {
//                                $key_el = "";
//                                foreach ($elem as $key => $el) {
//                                    if ($el == $this->search_word[$i] || $el == $two_word) {
//                                        $key_el = $el;
//                                        unset($elem[$key]);
//                                        unset($item[$k]);
////                                        dump(count($elem));
//                                        if (count($elem) != 0) {
//                                            foreach ($elem as $k_e => $e) {
//                                                $item[$k] = $e;
//                                            }
//                                        }
//
//                                    }
//
//
//                                }
//                                $this->array_world[$key_el][] = $item;
////                           array_push($this->array_world,$item);
//                            }
//
//                        }
//                    }
//
//                }
//
//            }
//        }
//        foreach ($this->array_world as $key => $elem) {
//
//            foreach ($elem as $key2 => $elem2) {
//                foreach ($elem2 as $key3 => $elem3) {
//
//                    if (is_array($elem3)) {
//                        unset($elem2[$key3]);
//                        unset($elem[$key2]);
//                        foreach ($elem3 as $val) {
//                            array_push($elem2, $val);
//
//                        }
//                        $elem[$key2] = $elem2;
//                        unset($this->array_world[$key]);
//                        $this->array_world[$key] = $elem;
//
//                    }
//
//                }
//
//
//            }
//
//        }
        return $this->array_world;
    }
}

function get_identity_names($array_ids)
{
    return FilterInput::whereIn('id', $array_ids)->pluck('title_hy');
}

// Translator
function translating($selector)
{
    // Translations
    $translation = Translation::where(['locale' => app()->getLocale(), 'selector' => $selector])->first();

    // Search result validation
    if (!empty($translation) && $translation != NULL) {
        // True value
        return $translation->translations;
    } else {
        // Selector value
        return $selector;
    }
}

// Price value with currency
function price_handler($price, $currency_id)
{
    // Validation Price
    if ($price == NUll || $price <= 0 || gettype($price) != 'integer') {
        $price = intval(1);
    }

    // Check Currency Data
    if (\Request::session()->has('currency') && \Request::session()->get('currency') != null) { // Already isset
        // Get currency session
        \Request::session()->get('currency');
    } else { // Not isset yet
        // Make currency session
        $request->session()->put('currency', 'amd');
    }

    // Get currency data
    $currency = Currency::where('type', \Request::session()->get('currency'))->first();

    // Check data
    if (isset($currency_id) && $currency_id > 0) {// Get currency data
        // Get currency data
        $currency = Currency::find($currency_id);
    }

    // Currency validation
    if (!isset($currency) && $currency == NULL) {
        // Custom currency value
        $currency_value = 1;
        $currency_simbol = translating('currency-simol-amd');
    } else {
        $currency_value = floatval($currency->value);
        $currency_simbol = $currency->simbol;
    }

    // Handling price
    $handled_price = floatval(intval($price) / floatval($currency_value));

    // Check handled price
    if ($handled_price <= 0) {
        $handled_price = 1;
    }

    // Return handled price value
    return number_format((float)$handled_price, 0, '.', '') . ' ' . $currency_simbol;
}

// Post options
function get_options($post_id)
{
    // Get this post option items
    $option_items = PostOption::where('post_id', $post_id)->get();

    // Make empty string
    $option_string = '';
//dd($option_items);
    // Loop from optoins
    foreach ($option_items as $key => $option_item) {
        // Chcek data
        if ($option_item->value != '#' && $option_item->option_id == 1) {
            // Append new value from old values total string
//            $option_string .= mb_substr($option_item->value,0, 7).', ';
            $option_string .= $option_item->value;
        }
    }

    // Return one option string
    return $option_string;
}

// Get posts count using this catgeoy
function getPostCountWithCategory($category_id)
{
    // Get childern categories ids
    $childrens = Category::where('parent_id', $category_id)->get('id');

    // Make category ids array
    $category_id_arr = array();

    // Loop from childens
    foreach ($childrens as $children) {
        array_push($category_id_arr, $children->id);
    }

    // Push  main category id
    array_push($category_id_arr, $category_id);

    // Get data
    $count = Post::whereIn('category_id', $category_id_arr)->count();

    // Return count
    return $count;
}

//Get Parents using category

function getParents($category_id = NULL, $parents = [])
{

    if ($category_id != 0) {
        $category = Category::where('id', $category_id)->firstOrFail();

        if ($category->parent_id != 0) {

            $parent = Category::where('id', $category->parent_id)->where('title_hy', '!=', 'Բոլոր բաժինները')->firstOrFail();
            if ($parent != null) {
                array_push($parents, $parent->id);

                getParents($parent->parent_id, $parents);
            }


        }

    }


    return $parents;
}

// Get subcategories using category
function getCategoryChildren($category_id = NULL)
{
    // Check request
    if (\Request::segment(2) == 'filter' || \Request::segment(2) == 'category' && \Request::segment(4) != NULl) {
        if ($category_id != 0) {
            // Get this item
            $cat = Category::findOrFail($category_id);

            // Chcek data
            if ($cat->root == 1) {
                $category_this_id = $cat->id;
            } else {
                $category_this_id = $cat->parent_id;
            }

            // Make empty category id array
            $category_id_arr = array();

            // Get this category sub items
            $sub_items = Category::where('parent_id', $category_this_id)->get('id');

            // Loop from array
            foreach ($sub_items as $sub_item) {
                // Push data
                array_push($category_id_arr, $sub_item->id);
            }

            // Push data
            array_push($category_id_arr, $category_id);

            // Get data
            $childrens = Category::whereIn('id', $category_id_arr)->orderBy('position_id', 'desc')->get();
        } else {
            // Get data
            $childrens = Category::where('has_subcategory', 1)->orderBy('position_id', 'desc')->get();
        }
    } else {
        // Get this item
        $cat = Category::findOrFail($category_id);

        // Chcek data
        if ($cat->root == 1) {
            $category_this_id = $cat->id;
        } else {
            $category_this_id = $cat->parent_id;
        }

        // Get this category sub items
        $sub_items = Category::where('parent_id', $category_this_id)->get('id');

        // Make empty category id array
        $category_id_arr = array();

        // Loop from array
        foreach ($sub_items as $sub_item) {
            // Push data
            array_push($category_id_arr, $sub_item->id);
        }

        // Push data
        array_push($category_id_arr, $category_id);

        // Get data
        $childrens = Category::whereIn('id', $category_id_arr)->orderBy('position_id', 'desc')->get();
    }

    // Return childrens data
    return $childrens;
}

function getCat($cat_id)
{

    $category = Category::where('id', $cat_id)->firstOrFail();
    return $category;
}

function YoutubeID($url)
{
    if (strlen($url) > 11) {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            return $match[1];
        } else
            return false;
    }

    return $url;
}

function getChildrensId($categorys)
{
    $array_ids = [];
//    dd($categorys);
    foreach ($categorys as $cat) {
        array_push($array_ids, $cat->id);

    }
    return $array_ids;

}

// Get post last update data
function getPostLastUpdate($post_id)
{
    // Get data
    $post = Post::where('id', $post_id)->first();
    if (is_null($post)) {
        $post = SparePartsStore::where('id', $post_id)->first();

    }
//dd($post);
    // Date validation
    $days_ago = date('Y-m-d H:i:s', strtotime('+5 days', strtotime($post['updated_at'])));

    // Validating
    if (!Auth::check() || Auth::user()->id != $post['user_id'] || $post == NULL || strtotime($days_ago) >= strtotime(date('Y-m-d H:i:s'))) {
        // Error response
        $update_access = false;
    } else {
        // Success response
        $update_access = true;
    }

    // Return update access type
    return $update_access;
}

// Format date time to default style
function date_default_format($date_time)
{
    // Make datetime array
    $date_time_arr = explode(' ', $date_time);

    // Check array values
    if (isset($date_time_arr[0]) && $date_time_arr[0] != NULL) { // Datetime array values is valid
        // Make date array
        $date_arr = explode('-', $date_time_arr[0]);

        // Check segment 1 value
        if (isset($date_arr[0]) && $date_arr[0] != NULL) { // Datetime array values is valid
            // Get date segment 1
            $date_segment_1 = $date_arr[0];

            // Split first 2 charecters
            $date_segment_1 = mb_substr($date_segment_1, 2, 4);
        } else { // Datetime array values is invalid
            // Get date segment 1 default value
            $date_segment_1 = '00';
        }

        // Check segment 2 value
        if (isset($date_arr[1]) && $date_arr[1] != NULL) { // Datetime array values is valid
            // Get date segment 2
            $date_segment_2 = $date_arr[1];
        } else { // Datetime array values is invalid
            // Get date segment 2 default value
            $date_segment_2 = '00';
        }

        // Check segment 3 value
        if (isset($date_arr[2]) && $date_arr[2] != NULL) { // Datetime array values is valid
            // Get date segment 3
            $date_segment_3 = $date_arr[2];
        } else { // Datetime array values is invalid
            // Get date segment 3 default value
            $date_segment_3 = '00';
        }

        // Return date formated value
        return $date_segment_3 . ' / ' . $date_segment_2 . ' / ' . $date_segment_1;
    } else { // Datetime array values is invalid
        // Return date default value
        return '00 / 00 / 00';
    }
}

// Format time time to default style
function time_default_format($date_time)
{
    // Make datetime array
    $date_time_arr = explode(' ', $date_time);

    // Check array values
    if (isset($date_time_arr[1]) && $date_time_arr[1] != NULL) { // Datetime array values is valid
        // Make date array
        $time_arr = explode(':', $date_time_arr[1]);

        // Check segment 1 value
        if (isset($time_arr[0]) && $time_arr[0] != NULL) { // Datetime array values is valid
            // Get date segment 1
            $time_segment_1 = $time_arr[0];
        } else { // Datetime array values is invalid
            // Get date segment 1 default value
            $time_segment_1 = '00';
        }

        // Check segment 2 value
        if (isset($time_arr[1]) && $time_arr[1] != NULL) { // Datetime array values is valid
            // Get date segment 2
            $time_segment_2 = $time_arr[1];
        } else { // Datetime array values is invalid
            // Get date segment 2 default value
            $time_segment_2 = '00';
        }

        // Check segment 3 value
        if (isset($time_arr[2]) && $time_arr[2] != NULL) { // Datetime array values is valid
            // Get date segment 3
            $time_segment_3 = $time_arr[2];
        } else { // Datetime array values is invalid
            // Get date segment 3 default value
            $time_segment_3 = '00';
        }

        // Return date formated value
        return $time_segment_1 . ' : ' . $time_segment_2 . ' : ' . $time_segment_3;
    } else { // Datetime array values is invalid
        // Return date default value
        return '00 : 00 : 00';
    }
}

// Path Back Slashes Make Forward Slash
function pathBackMakeForwardSlash($path)
{
    // Replace string
    return str_replace('\\', '/', $path);
}

// Path Forward Slashes Make Back Slash
function pathForwardMakeBackSlash($path)
{
    // Replace string
    return str_replace('/', '\\', $path);
}

// Get user avrage rating value
function getUserAvgStars($user_id)
{
    // Get data
    $rating = UserRating::where('user_id', $user_id)->avg('rate');

    // Return rounded math rating avrage value
    return round($rating);
}

function get_image_models()
{
    return [
        "1" => [
            "models" => "Transportation,Automobile,Cushion,Car Seat,Car,Machine,Vehicle,Headrest,Truck,Tire,Wheel,
                         Car Wheel,Bus Stop,Bus,Tour Bus,Motorcycle,Bicycle,Bike",
            "probably" => "80",
            "failed" => "Տեղադրեք համապատասխան (Տրանսպորտ) բաժնին պատկանող լուսանկար(ներ)"
        ],
        "2" => [
            "models" => "Flooring,Floor,Chair,Furniture,Rug,Lobby,Room,Indoors,Interior,Design,Living Room,Home Decor,Bedroom,Bed,Plant,Grass,Lawn,Housing,Building,Mansion,
                         House,Cottage,Wood,Sideboard,Clinic,Dining Room,Table,Resort,Hotel,Pool,Water,Swimming Pool,Map,Diagram,Nature,Plot,Outdoors,Land,Landscape,Scenery,
                         Garage,Field,Agriculture,Countryside,Rug,Vegetation,Aerial View,Workshop,Tabletop,Sitting,Sweets,Floor,Restaurant,Neighborhood,Urban,
                         Grocery Store,Shop,Confectionery,Market,Street,Road,City,Town,Metropolis,Bazaar,Shelter,Rural,Convention Center,Architecture,Soil,Ground,
                         Brick,Bridge,Supermarket,Panoramic,Cooktop",
            "probably" => "80",
            "failed" => "Տեղադրեք համապատասխան (Անշարժ Գույք) բաժնին պատկանող լուսանկար(ներ)"
        ],
        "3" => [
            "models" => "Electronics,Cell Phone,Phone,Mobile Phone,Mouse,Computer,Hardware,Electronic Chip,Cpu,Computer Hardware,Stereo,
            Amplifier,Appliance,Wristwatch,Headphones,Headset,Accessories,Accessory,Pc,Monitor,Display,Screen,LCD Screen,TV,Television,
            Laptop,Computer Keyboard,Keyboard,Audio Speaker,Speaker,Camera,Home Theater,Document,Remote Control,Tablet Computer,Adapter,Helmet,
            Digital Watch",
            "probably" => "80",
            "failed" => "Տեղադրեք համապատասխան (Էլեկտրոնիկա) բաժնին պատկանող լուսանկար(ներ)"
        ],

    ];
}

function create_assoc_models_probably($array_models_real)
{
    $result_array = [];
    foreach ($array_models_real as $elem) {
        $result_array[$elem['Name']] = intval($elem['Confidence']);
    }

    return $result_array;
}

function check_permissibility_probablies($matches_models_image, $permission_probably)
{
    $matches_count = count($matches_models_image);
    $average_percent = array_sum($matches_models_image) / $matches_count;
    return $average_percent >= $permission_probably ? true : false;
}

function recognize_image($array_models, $category_ids)
{
    $response_array = array();
    $array_assoc_models_info = create_assoc_models_probably($array_models);
    $cur_models_list = [];
    $cur_probably = [];
    $cur_model_probably = [];
    $image_assoc_models = get_image_models();
    foreach ($image_assoc_models as $key => $current_assoc) {
        if (in_array($key, $category_ids)) {
            $cur_models_list = explode(',', $current_assoc['models']);
            $cur_probably = $current_assoc['probably'];
//            Set all models probably %
            $cur_model_probably = array_fill_keys($cur_models_list, $cur_probably);
            $matches_models = array_intersect_key($array_assoc_models_info, $cur_model_probably);
            if (count($matches_models) > 0) {
                $is_permissible = check_permissibility_probablies($matches_models, $cur_probably);
                $is_permissible ? array_push($response_array, ['success' => true]) : array_push($response_array, ['failed' => $current_assoc['failed']]);
            } else {
                array_push($response_array, ['failed' => $current_assoc['failed']]);
            }
        }
    }
    return $response_array;
}

// Get post breadrcumbs data
function getPostBreadcrumbs($category_id)
{
    // Get localization title
    $title = 'title_' . app()->getLocale();

    // Get category
    $category = Category::findOrFail($category_id);

    // Push data
    $breadcrumbs[0] = (object)[
        'id' => $category->id,
        'title' => $category->$title
    ];

    // Get subcategory
    $subcategory = Category::where('id', $category->parent_id)->first();

    // Check data
    if (isset($subcategory) && $subcategory != NULL && isset($subcategory->parent_id)) {
        // Push data
        $breadcrumbs[1] = (object)[
            'id' => $subcategory->id,
            'title' => $subcategory->$title
        ];

        // Get sub subsubcategory
        $subsubcategory = Category::where('id', $subcategory->parent_id)->first();

        // Check data
        if (isset($subsubcategory) && $subsubcategory != NULL) {
            // Push data
            $breadcrumbs[1] = (object)[
                'id' => $subsubcategory->id,
                'title' => $subsubcategory->$title
            ];
        }
    }

    // Return breadcrumbs array
    return $breadcrumbs;
}


function getUserPostCount($user_id)
{
    // Get this user posts count
    $count = Post::where('user_id', $user_id)->count();

    // Return count
    return $count;
}

// Get Admin Email Receiver Email
function getAdminReceiverEmail()
{
    // Get data
    $site = SiteData::first();

    // Check data
    if (isset($site->email) && $site->email != NULL) {
        // Get email
        $email = $site->email;
    } else {
        // Make Email
        $email = 'info@yerevan.vip';
    }

    // Return email data
    return $email;
}

