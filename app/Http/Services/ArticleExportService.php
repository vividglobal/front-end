<?php

namespace App\Http\Services;

use App\Http\Services\UserRoleService;
use App\Http\Services\ExportService;

use App\Models\Mongo\Article;

class ArticleExportService {

    public function exportPendingArticles($fileName, $articles) {
        $titles = [
            'No','Country', 'Company', 'Brand', 'Caption', 'Image', 'Published Date', 'Crawl Date', 'Link',
            'VIVID - Status', 'VIVID - Code Article', 'VIVID - Violation Type',
        ];
        $isSupervisor = UserRoleService::isSupervisor();
        $isOperator = UserRoleService::isOperator();

        if($isSupervisor || $isOperator) {
            $titles = array_merge($titles, ['SUPERVISOR - Status', 'SUPERVISOR - Code Article', 'SUPERVISOR - Violation Type']);
        }
        if($isOperator) {
            $titles = array_merge($titles, ['OPERATOR - Status', 'OPERATOR - Code Article', 'OPERATOR - Violation Type']);
        }

        $exportData = [];

        foreach ($articles as $key => $article) {
            $botStatus = $article->detection_result['status'] ?? count($article->detection_result['violation_code']) > 0 ? Article::STATUS_VIOLATION : Article::STATUS_NONE_VIOLATION ;
            $publishedDate = $article->published_date ? date('Y-m-d', $article->published_date) : '';
            $crawlDate = $article->crawl_date ? date('Y-m-d', $article->crawl_date) : '';
            $row = [
                $key+1,
                $article->country['name'] ?? '',
                $article->company['name'] ?? '',
                $article->brand['name'] ?? '',
                $article->caption,
                $article->image,
                $publishedDate,
                $crawlDate,
                $article->link,
                $botStatus,
                convertArrayToString($article->detection_result['violation_code'], 'name'),
                convertArrayToString($article->detection_result['violation_types'], 'name')
            ];

            if($isSupervisor || $isOperator) {
                $violationStatus =  getStatusText($article->supervisor_review['status']) ;
                $violationCodeNames = '';
                $violationTypeNames = '';
                if($article->supervisor_review['status'] === Article::STATUS_VIOLATION) {
                    $violationCodeNames = convertArrayToString($article->supervisor_review['violation_code'], 'name');
                    $violationTypeNames = convertArrayToString($article->supervisor_review['violation_types'], 'name');
                }
                $row[] = $violationStatus;
                $row[] = $violationCodeNames;
                $row[] = $violationTypeNames;
            }
            if($isOperator) {
                $violationStatus = getStatusText($article->operator_review['status']);
                $violationCodeNames = '';
                $violationTypeNames = '';
                if($article->operator_review['status'] === Article::STATUS_VIOLATION) {
                    $violationCodeNames = convertArrayToString($article->operator_review['violation_code'], 'name');
                    $violationTypeNames = convertArrayToString($article->operator_review['violation_types'], 'name');
                }
                $row[] = $violationStatus;
                $row[] = $violationCodeNames;
                $row[] = $violationTypeNames;
            }
            $exportData[] = $row;
        }

        $sheets = [
            [ 'row_titles' => $titles, 'name' => $fileName, 'data' => $exportData ]
        ];
        return ExportService::exportExcelFile($sheets, $fileName);
    }

    public function exportViolationArticles($fileName, $articles) {
        $titles = [
            'No', 'Country', 'Company', 'Brand', 'Caption', 'Image', 'Published Date', 'Checking Date',
            'Penalty issued','Link', 'Legal documents', 'Code Article', 'Violation Type', 'Status Progress'
        ];
        $exportData = [];
        foreach ($articles as $key => $article) {
            $penaltyIssued = ''; // Last upload documents
            $legalDocuments = ''; // From documents collection _id = article_id
            if($article->has_document) {
                $legalDocuments = [];
                $penaltyIssued = $article->penalty_issued ? date('Y-m-d', $article->penalty_issued/1000) : '';;
                foreach ($article->documents as $document) {
                    $legalDocuments[] = $document->url;
                }
                $legalDocuments = implode('', $legalDocuments);
            }
            $publishedDate = $article->published_date ? date('Y-m-d', $article->published_date) : '';
            $checkingDate = $article->operator_review['review_date'] ? date('Y-m-d', $article->operator_review['review_date']) : '';
            $row = [
                $key+1,
                $article->country['name'] ?? '',
                $article->company['name'] ?? '',
                $article->brand['name'] ?? '',
                $article->caption,
                $article->image,
                $publishedDate,
                $checkingDate,
                $penaltyIssued,
                $article->link,
                $legalDocuments,
                convertArrayToString($article->operator_review['violation_code'], 'name'),
                convertArrayToString($article->operator_review['violation_types'], 'name'),
                $article->progress_status ??  Article::PROGRESS_NOT_STARTED,
            ];

            $exportData[] = $row;
        }
        $sheets = [
            ['row_titles' => $titles, 'name' => $fileName, 'data' => $exportData ]
        ];

        return ExportService::exportExcelFile($sheets, $fileName);
    }

    public function exportNoneViolationArticles($fileName, $articles) {
        $titles = [
            'No', 'Country', 'Company', 'Brand', 'Caption', 'Image', 'Published Date', 'Checking Date', 'Link'
        ];
        $exportData = [];
        foreach ($articles as $key => $article) {
            $publishedDate = $article->published_date ? date('Y-m-d', $article->published_date) : '';
            $checkingDate = $article->operator_review['review_date'] ? date('Y-m-d', $article->operator_review['review_date']) : '';
            $row = [
                $key+1,
                $article->country['name'] ?? '',
                $article->company['name'] ?? '',
                $article->brand['name'] ?? '',
                $article->caption,
                $article->image,
                $publishedDate,
                $checkingDate,
                $article->link,
            ];

            $exportData[] = $row;
        }
        $sheets = [
            ['row_titles' => $titles, 'name' => $fileName, 'data' => $exportData ]
        ];

        return ExportService::exportExcelFile($sheets, $fileName);
    }
}
