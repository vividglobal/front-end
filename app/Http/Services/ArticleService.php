<?php

namespace App\Http\Services;
use App\Models\Mongo\Article;
use App\Models\Mongo\CompanyBrand;
use App\Models\Mongo\Country;
use App\Models\Mongo\ViolationCode;
use MongoDB\BSON\Regex;

class ArticleService
{
    const MAX_GENERATED_ARTICLES = 500;
    const DOMAIN_FANPAGES = ['www.instagram.com', 'www.facebook.com'];

    public function createDummy(
        $generatedArticle = self::MAX_GENERATED_ARTICLES,
        $articleDetectionType = null,
        $articleDetetionCountry = null,
        $articleDetetionImage = null,
        $articleDetetionUrl = null,
        $articleDetetionCaption = null,
        $articleDetetionPublishedDate = null,
        $articleDetetionCrawlDate = null
    ){
        $companies = $countries = $violationCode = [];
        foreach (Country::all() as $key => $country) {
            $countries[] = [
                'id' => $country->_id,
                'name' => $country->name,
            ];
        }
        foreach (CompanyBrand::all() as $key => $brand) {
            $companies[] = [
                'id' => $brand->_id,
                'name' => $brand->name,
            ];
        }
        foreach (ViolationCode::all() as $key => $code) {
            $violationCode[] = $code->_id;
        }
        $imgAndLinks = [
            ['img' => 'https://static.hotdeal.vn/images/726/726439/500x500/153341-hop-sua-bot-meta-care-1-su-lua-chon-toi-uu-cho-tre-viet-900g.jpg', 'link' => 'https://www.hotdeal.vn/ho-chi-minh/thuc-pham/hop-sua-bot-meta-care-1-su-lua-chon-toi-uu-cho-tre-viet-900g-153341.html'],
            ['img' => 'https://www.hangngoainhap.com.vn/images/201805/goods_img/2296_P_1527303461160.jpg', 'link' => 'https://www.hangngoainhap.com.vn/2296-sua-bot-ensure-original-nutrition-powder-hop-400g-cua-my.html'],
            ['img' => 'https://bizweb.dktcdn.net/100/399/829/files/meiji-lon-so-0-800gr.jpg?v=1602141858299', 'link' => 'https://bekhoemexinh.com.vn/sua-bot-meiji-so-0-hop-800g-cho-tre-so-sinh-den-1-tuoi'],
            ['img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQClAAkHljjGI7ma18TojQuGVXGpW70hm1OyA&usqp=CAU', 'link' => 'https://suahop.vn/sua-bot-similac-isomil-iq-1-400g-237.html'],
            ['img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuALp0Dzi00tHo-i_E5FXfkdm5ax_rD3_EeQ&usqp=CAU', 'link' => 'https://shoptretho.com.vn/sua-bot-pediasure-ba-1600gr-1-10-tuoi'],
            ['img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuALp0Dzi00tHo-i_E5FXfkdm5ax_rD3_EeQ&usqp=CAU', 'link' => 'http://mychau.com.vn/hop-dung-sua-bot-nha-san-xuat-hop-dung-sua.html'],
            ['img' => 'https://www.queanhfood.vn/wp-content/uploads/2019/06/B%E1%BB%98T-%C4%82N-D%E1%BA%B6M-RIDIELAC-GOLD-G%E1%BA%A0O-S%E1%BB%AEA-H%E1%BB%98P-THI%E1%BA%BEC-350G.jpg', 'link' => 'https://www.queanhfood.vn/san-pham/bot-an-dam-ridielac-gold-gao-sua-hop-thiec-350g'],
            ['img' => 'https://www.queanhfood.vn/wp-content/uploads/2019/06/B%E1%BB%98T-%C4%82N-D%E1%BA%B6M-RIDIELAC-GOLD-G%E1%BA%A0O-S%E1%BB%AEA-H%E1%BB%98P-THI%E1%BA%BEC-350G.jpg', 'link' => 'https://www.queanhfood.vn/san-pham/bot-an-dam-ridielac-gold-gao-sua-hop-thiec-350g'],
            ['img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUNlcE_XlGcQFcpoYJJ0reXCkC-SSIIb1FWA&usqp=CAU', 'link' => 'https://shoptretho.com.vn/sua-bot-pediasure-ba-1600gr-1-10-tuoi'],
            ['img' => 'https://vn-test-11.slatic.net/p/c2ce4a21da13450eb390c0277bf296af.jpg', 'link' => 'https://www.lazada.vn/tag/sua-bot-hop/?innerlink=hot_v1']
        ];
        $detectionType = ['BOT'];
        $dectionStatus = [Article::STATUS_NONE_VIOLATION, Article::STATUS_VIOLATION];

        $listArticles = [];

        // Article
        for ($i=0; $i < $generatedArticle ; $i++) {
            $botStatus = $dectionStatus[array_rand($dectionStatus)];
            if($botStatus === Article::STATUS_NONE_VIOLATION) {
                $violation_types_arr = $violation_code_arr = [];
            }else {
                $totalRandomCode = rand(0, 19);
                $listCodeIds = [];
                for ($j=0; $j < $totalRandomCode; $j++) { 
                    $listCodeIds[] = $violationCode[array_rand($violationCode)];
                }
                $listCodeIds = array_unique($listCodeIds);

                $codeData = $this->getViolationCodeAndTypeData($listCodeIds);
                $violation_code_arr = $codeData['violation_code'];
                $violation_types_arr = $codeData['violation_types'];
            }

            $articleDetectionType = $detectionType[array_rand($detectionType)];

            $articleDetetionCountry = $countries[array_rand($countries)];

            $imgAndLink = $imgAndLinks[array_rand($imgAndLinks)];
            $articleDetetionImage = $imgAndLink['img'];

            $articleDetetionUrl = $imgAndLink['link'];

            if($articleDetetionCaption === null) {
                $articleDetetionCaption = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
            }

            $articleDetetionPublishedDate = mt_rand(strtotime('01-05-2022'), time());
            $articleDetetionCrawlDate = mt_rand(strtotime('01-05-2022'), time());

            $article = [
                'company' => [],
                'country' => $articleDetetionCountry,
                'brand'   => $companies[array_rand($companies)],
                'caption' => $articleDetetionCaption,
                'image'   => $articleDetetionImage,
                'link'    => $articleDetetionUrl,
                'published_date'   => $articleDetetionPublishedDate,
                'detection_result' => [
                    'violation_code'  => $violation_code_arr,
                    'violation_types' => $violation_types_arr,
                    'status'          => $botStatus,
                    'crawl_date'      => $articleDetetionCrawlDate
                ],
                'supervisor_review' => [
                    'violation_code'  => [],
                    'violation_types' => [],
                    "status"          => "PENDING",
                    'review_date'     => null
                ],
                'operator_review' => [
                    'violation_code'  => [],
                    'violation_types' => [],
                    "status"          => "PENDING",
                    'review_date'     => null
                ],
                'status'         => 'PENDING',
                'detection_type' => $articleDetectionType,
            ];

            $listArticles[] = Article::create($article);
        }
        return $listArticles;
    }

    public function getViolationCodeAndTypeData($violationCodeArr) {
        $codex = ViolationCode::whereIn('_id', $violationCodeArr)->get();
        if($codex) {
            $listCode = [];
            $listTypes = [];
            foreach ($codex as $key => $code) {
                $listCode[] = [
                    'id' => $code->_id,
                    'name' => $code->name,
                ];
                $type = $code->violationType()->first();
                $listTypes[] = [
                    'id'    => $type->_id,
                    'name'  => $type->name,
                    'color' => $type->color
                ];
            }
            $violationTypes = getUniqueArray('id', $listTypes);

            return [
                'violation_code'  => $listCode,
                'violation_types' => $violationTypes
            ];
        }

        return [];
    }

    public function createArticleFromAIDetection($detectData, $detectionType = Article::DETECTION_TYPE_MANUAL) {
        $brandData = [];
        $companyData = [];
        if(isset($detectData['brands']) && count($detectData['brands']) > 0) {
            $brandName = $detectData['brands'][0];
            $brand = CompanyBrand::where('name', 'like', '%' . $brandName . '%')->first();
            if($brand) {
                if($brand->type === CompanyBrand::TYPE_BRAND) {
                    if(isset($brand->parent_id)) {
                        $company = CompanyBrand::find($brand->parent_id);
                        if($company) {
                            $companyData = [
                                'id'   => $company->_id,
                                'name' => $company->name
                            ];
                        }
                    }
                    $brandData = [
                        'id'   => $brand->_id,
                        'name' => $brand->name
                    ];
                }else {
                    $companyData = [
                        'id'   => $brand->_id,
                        'name' => $brand->name
                    ];
                }
            }
        }

        $countryData = [];
        if(isset($detectData['country_id'])) {
            $country = Country::find($detectData['country_id']);
            if($country) {
                $countryData = [
                    'id'   => $country->_id,
                    'name' => $country->name
                ];
            }
        }else if(isset($detectData['url_page'])) {
            $pageUrl = $detectData['url_page'];
            $parsedUrl = parse_url($pageUrl);
            $host = $parsedUrl['host'];
            $keySearch = in_array($host, self::DOMAIN_FANPAGES) ? $pageUrl : $host;
            $country = Country::where('list_url', 'LIKE', '%' . $keySearch . '%')->first();
            if($country) {
                $countryData = [
                    'id'   => $country->_id,
                    'name' => $country->name
                ];
            }
        }

        $image              = (isset($detectData['imgs']) && count($detectData['imgs']) > 0)
                                ? $detectData['imgs'][0] : '';
        $gallery            = isset($detectData['imgs']) ? $detectData['imgs'] : [];
        $caption            = isset($detectData['text']) ? $detectData['text'] : '';
        $violationCodeNames =  (isset($detectData['violations']) && count($detectData['violations']) > 0)
                                ? $detectData['violations'] : [];
        $publishedDate      = isset($detectData['post_time']) && $detectData['post_time'] != ''
                                ? strtotime(str_replace('/', '-', $detectData['post_time'])) : null; // post_time format as d/m/Y
        $link               = isset($detectData['url']) ? $detectData['url'] : '';

        $newArticle = [
            'company'          => $companyData,
            'country'          => $countryData,
            'brand'            => $brandData,
            'caption'          => $caption,
            'image'            => $image,
            'gallery'          => $gallery,
            'link'             => $link,
            'published_date'   => $publishedDate,
            'status'           => Article::STATUS_PENDING,
            'detection_type'   => $detectionType,
        ];

        if(count($violationCodeNames) === 0) {
            $newArticle['detection_result'] = [
                'violation_code'  => [],
                'violation_types' => [],
                'status'          => Article::STATUS_NONE_VIOLATION,
                'crawl_date'      => time()
            ];
        }else {
            $violationCodex = ViolationCode::whereIn('name', $violationCodeNames)->get();

            if(!$violationCodex) {
                return [
                    'success' => false,
                    'error'   => 'Invalid violations code : '.implode(', ', $violationCodeNames)
                ];
            }

            $violationCodexData = [];
            $violationTypesData = [];
            foreach ($violationCodex as $key => $code) {
                $violationCodexData[] = [
                    'id' => $code->_id,
                    'name' => $code->name
                ];
                $type = $code->violationType()->first();
                $violationTypesData[] = [
                    'id'    => $type->_id,
                    'name'  => $type->name,
                    'color' => $type->color
                ];
            }

            // Remove duplicated types
            $violationTypesData = getUniqueArray('id', $violationTypesData);
            
            $newArticle['detection_result'] = [
                'violation_code'  => $violationCodexData,
                'violation_types' => $violationTypesData,
                'status'          => Article::STATUS_VIOLATION,
                'crawl_date'      => time()
            ];
        }

        $article = Article::create($newArticle);

        return [
            'success' => true,
            'data' => $article
        ];
    }
}