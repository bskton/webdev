<?php

namespace App\Parsers;

use DOMNode;

use Symfony\Component\DomCrawler\Crawler;
use Storage;

/**
 * Парсер РЛС
 *
 * Парсит алфавитный указатель РЛС. Содержит парсес для главной страницы, парсер для каждой
 * буквы алфавита и парсер страницы лекарственного средства.
 *
 * @package App\Parsers
 */
class Rls
{
    /**
     * @var Crawler Предназначен для работы с DOM страницы
     */
    protected $crawler;

    /**
     * @var array Для каждой секции задано имя, соответсвующий ему якорь на странице и метод,
     * с помощью котрого можно спарсить данную секцию. Якорь - это никальная строка, по которой однозначно
     * можно найти секцию на странице.
     */
    protected $sectionsAnchors = [
        // Название
        'name' => [
            'anchor' => '#page_head',
            'method' => 'grubName'
        ],
        // Описание лекарственной формы
        'lekForm' => [
            'anchor' => 'opisanie-lekarstvennoj-formy',
            'method' => 'grubSection'
        ],
        // Фармакологическое действие
        'pharmEffect' => [
            'anchor' => 'farmakologicheskoe-dejstvie',
            'method' => 'grubSection'
        ],
        // Противопоказания
        'contraindications' => [
            'anchor' => 'protivopokazaniya',
            'method' => 'grubSection'
        ],
        // Побочные действия
        'sideEffects' => [
            'anchor' => 'pobochnye-dejstviya',
            'method' => 'grubSection'
        ],
        // Взаимодействие
        'interaction' => [
            'anchor' => 'vzaimodejstvie',
            'method' => 'grubSection'
        ],
        // Способ применения и дозы
        'dosing' => [
            'anchor' => 'sposob-primeneniya-i-dozy',
            'method' => 'grubSection'
        ],
        // Комментарий
        'comment' => [
            'anchor' => 'kommentarij',
            'method' => 'grubSection'
        ],
        // Применение при беременности и кормлении грудью
        'pregnancy' => [
            'anchor' => 'primenenie-pri-beremennosti-i-kormlenii-grud`yu',
            'method' => 'grubSection'
        ],
        // Нозологическая классификация
        'mkbs' => [
            'anchor' => 'a[name="nozologicheskaya-klassifikaciya-mkb-"]',
            'method' => 'grubMkbs'
        ],
        // Состав и форма выпуска
        'composition' => [
            'anchor' => 'table.sostav_table tr',
            'method' => 'grubComposition'
        ],
        // Показания препарата
        'indications' => [
            'anchor' => 'Показания препарата',
            'method' => 'grubSectionByTitle'
        ],
        // Условия хранения препарата
        'storageConditions' => [
            'anchor' => 'Условия хранения препарата',
            'method' => 'grubSectionByTitle'
        ],
        // Срок годности препарата
        'shelfLife' => [
            'anchor' => 'Срок годности препарата',
            'method' => 'grubSectionByTitle'
        ],
        // Фармакодинамика
        'pharmacodynamics' => [
            'anchor' => 'farmakodinamika',
            'method' => 'grubSection'
        ],
        // Фармакокинетика
        'pharmacokinetics' => [
            'anchor' => 'farmakokinetika',
            'method' => 'grubSection'
        ],
        // TODO: Добавить Взаимодействие
        // Передозировка
        'overdose' => [
            'anchor' => 'peredozirovka',
            'method' => 'grubSection'
        ],
        //Особые указания
        'specialInstructions' => [
            'anchor' => 'osobye-ukazaniya',
            'method' => 'grubSection'
        ]
    ];

    public function parseIndex($file)
    {
        $html = Storage::get($file);
        $crawler = new Crawler($html);
        $crawler = $crawler->filter('table.alphabet__rustable th a');
        foreach ($crawler as $domElement) {
            var_dump($domElement->getAttribute('href'));
        }
    }

    public function parseLetter($file)
    {
        $html = Storage::get($file);
        $crawler = new Crawler($html);
        $crawler = $crawler->filter('div.tn_alf_list ul li a');
        foreach ($crawler as $domElement) {
            var_dump($domElement->getAttribute('href'));
        }
    }

    /**
     * Парсер страницы торгового наименования
     *
     *
     *
     * @param string $file Пусть к HTML файлу
     *
     * @return array Массив с результатами парсинга
     */
    public function parseTradeName($file)
    {
        $html = Storage::get($file);
        $this->crawler = new Crawler($html);
        $crawler = $this->crawler;

        // Формы выпуска
        $formsCrawler = $crawler->filter('#preplist ul>li>div>a');
        $forms = [];
        foreach ($formsCrawler as $node) {
            $form['code'] = str_replace(['javascript:%20toggleList(\'', '\')'], '', 
                $node->getAttribute('href'));
            $form['title'] = $node->nodeValue;
            $forms[] = $form;
        }
        $result['forms'] = $forms;

        // Действующее вещество
        $mnnCrawler = $crawler->filter('a.drug__link');
        $result['mnn'] = $mnnCrawler->text();

        // Фармакологические группы
        $pharmGroupCrawler = $crawler->filter('a[name="farmakologicheskie-gruppy"]');
        if ($pharmGroupCrawler->count() == 0) {
            $pharmGroupCrawler = $crawler->filter('a[name="farmakologicheskaya-gruppa"]');
        }
        $pharmGroupCrawler = $pharmGroupCrawler->nextAll()->nextAll()->children()->filter('a');
        $pharmGroups = [];
        foreach($pharmGroupCrawler as $node) {
            $pharmGroups[] = $node->nodeValue;
        }
        $result['pharmGroups'] = $pharmGroups;

        foreach ($this->sectionsAnchors as $k => $v) {
            $method = $v['method'];
            $value = $this->$method($v['anchor']);
            if ($value) {
                $result[$k] = $value;
            }
        }

        return $result;
    }

    private function grubName($anchor)
    {
        $headCrawler = $this->crawler->filter($anchor)->children();

        return trim($headCrawler->getNode(0)->previousSibling->wholeText);
    }

    private function isToBegining($text)
    {
        return 'В начало' == trim(
            str_replace(html_entity_decode("&nbsp;"), ' ',
                str_replace('^', '', $text)));
    }

    private function grubUntilToBegining($crawler)
    {
        $result = [];
        for (;$crawler = $crawler->nextAll();)
        {
            $node = $crawler->getNode(0);
            // Способ получить текст вместе с HTML разметкой
            $innerHTML = $this->DOMinnerHTML($node);
            $text = $crawler->text();
            if ($this->isToBegining($text)) {
                break;
            }
            $result[] = $this->removeMultiSpaces($this->removeNbsp($text));
        }

        return $result;
    }

    private function grubUntilToBeginingByNode($crawler)
    {
        $result = [];
        $node = $crawler->getNode(0)->nextSibling;
        for (; !$this->isToBegining($node->nodeValue); $node = $node->nextSibling) {
            $value = $this->removeNbsp($node->nodeValue);
            if ($value) {
                $result[] = $this->clean($value);
            }
        }

        return $result;
    }

    private function grubSection($anchor)
    {
        $result = [];

        $cssSelector = 'a[name="'.$anchor.'"]';
        $sectionCrawler = $this->crawler->filter($cssSelector);

        if ($sectionCrawler->count() != 0) {
            $sectionCrawler = $sectionCrawler->nextAll();
            $result = $this->grubUntilToBegining($sectionCrawler);
        }
        
        return $result;
    }

    private function removeNbsp($str)
    {
        return trim(str_replace(html_entity_decode("&nbsp;"), ' ', $str));
    }

    private function grubSectionByTitle($title)
    {
        $result = [];

        $titleCrawler = $this->crawler->filter('#tn_content > h2');
        $haveTitle = false;
        for (; $titleCrawler->count() != 0; $titleCrawler = $titleCrawler->nextAll()) {
            if (strpos($titleCrawler->text(), $title) !== false) {
                $haveTitle = true;
                break;
            }
        }

        if ($haveTitle) {
            $result = $this->grubUntilToBeginingByNode($titleCrawler);
        }

        return $result;
    }

    private function grubMkbs($anchor)
    {
        $result = [];
        $mkbCrawler = $this->crawler->filter($anchor);
        if ($mkbCrawler->count() != 0) {
            $mkbCrawler = $mkbCrawler->nextAll()->nextAll()->children()->filter('a');
            $mkbs = [];
            foreach($mkbCrawler as $node) {
                $mkbs[] = $node->nodeValue;
            }
            $result = $mkbs;
        }

        return $result;
    }

    private function grubComposition($anchor)
    {
        $compositionCrawler = $this->crawler->filter($anchor);
        $result = [];
        foreach($compositionCrawler as $node) {
            $row = [];
            foreach($node->childNodes as $childNode) {
                if ($childNode->nodeType == XML_ELEMENT_NODE) {
                    // TODO: Во всех местах перед тем как сохранять строку в массив с результатом, очищать ее от лишних символов
                    $row[] = $this->clean($childNode->nodeValue);
                }
            }
            $result[] = $row;
        }
        
        return $result;
    }

    private function DOMinnerHTML(DOMNode $element) 
    {
        $innerHTML = ""; 
        $children  = $element->childNodes;

        foreach ($children as $child) 
        { 
            $innerHTML .= $element->ownerDocument->saveHTML($child);
        }

        return $innerHTML; 
    }

    private function removeMultiSpaces($str)
    {
        return preg_replace('/\s+/', ' ', $str);
    }

    /**
     * Чистит строку от лишних символов
     *
     * Заменяет неколько пробелов подряд на один пробел, удаляет пустые символы
     * в начале и конце строки, заменяет &nbsp на пробел.
     *
     * @param string $str Произвольная строка
     *
     * @return string
     */
    private function clean($str)
    {
        return trim($this->removeMultiSpaces($this->removeNbsp($str)));
    }
}