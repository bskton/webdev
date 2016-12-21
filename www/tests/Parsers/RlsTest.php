<?php

use App\Parsers\Rls;

class RlsTest extends TestCase
{
    public function testParseTradeName()
    {
        $result = [
            'name' => 'А.Т.10',
            'forms' => [[
                'code' => 'drugform164',
                'title' => 'раствор для приема внутрь (1)'
            ]],
            'mnn' => 'Дигидротахистерол* (Dihydrotachysterolum)',
            'pharmGroups' => [
                'Регулятор обмена кальция и фосфора [Корректоры метаболизма костной и хрящевой ткани]',
                'Витамины и витаминоподобные средства'
            ],
            'mkbs' => [
                'E20 Гипопаратиреоз',
                'E55 Недостаточность витамина D',
                'R29.0 Тетания'
            ],
            'composition' => [
                ['Раствор для приема внутрь', '1 мл'],
                ['дигидротахистерол', '1 мг'],
                ['вспомогательные вещества: триглицериды со средней длиной цепи', '']
            ],
            'lekForm' => [
                'Прозрачный, слегка желтоватый масляный раствор.'
            ],
            'pharmEffect' => [
                'Фармакологическое действие - D-витаминоподобное',
                'Регулирует обмен кальция и фосфора, повышает уровень кальция в крови за счет усиления его всасывания из кишечника и высвобождения из костей.'
            ],
            'indications' => [
                'Гипопаратиреоз; псевдогипопаратиреоз; тетания; заболевания костей, обусловленные дефицитом витамина D.'
            ],
            'contraindications' => [
                'Гиперкальциемия, отравление диоксидом углерода, тетанические судороги.'
            ],
            'pregnancy' => [
                'Допустимо, однако только под врачебным контролем.'
            ],
            'sideEffects' => [
                'Гиперкальциемия, потеря аппетита, диспептические расстройства, повышенная утомляемость, жажда, головная боль, полиурия, отложение кальция в тканях (кальцификация).'
            ],
            'interaction' => [
                'Несовместим с препаратами кальция, паратиреоидным гормоном, некоторыми диуретиками, витамином D и подобными ему веществами.'
            ],
            'dosing' => [
                 'Внутрь, натощак или после еды с небольшим количеством жидкости, можно — с пищей (например на кусочке хлеба или сахара); масляный раствор не смешивается с водой.',
                 'Суточная доза определяется врачом индивидуально, в зависимости от уровня кальция в крови.',
                 '0,5 мг препарата А.Т.10® соответствует примерно 15 каплям.',
                 'Рекомендуемые дозы: при гипопаратиреозе — 0,75–2,5 мг/сут в течение нескольких дней, поддерживающая доза — 0,2–1 мг/сут.',
                 'Суточную дозу препарата можно принимать в несколько приемов. Длительность лечения определяется врачом.',
                 'Лечение препаратом А.Т.10® нельзя прерывать самостоятельно.'
            ],
            'comment' => [
                'В настоящее время препарат снят с производства.'
            ],
            'storageConditions' => [
                'В защищенном от света месте, при температуре 18–25 °C.',
                'Хранить в недоступном для детей месте.'
            ],
            'shelfLife' => [
                '5 лет.',
                'Не применять по истечении срока годности, указанного на упаковке.'
            ]
        ];
        $rls = new Rls();
        $this->assertEquals($result, 
            $rls->parseTradeName('rlsnet/html/tradenames/tn_index_id_35.htm'));


        $result = [
            'name' => 'Абаджио',
            'forms' => [[
                'code' => 'drugform628',
                'title' => 'таблетки, покрытые пленочной оболочкой (9)'
            ]],
            'mnn' => 'Терифлуномид* (Teriflunomidum)',
            'pharmGroups' => [
                'Иммунодепрессанты'
            ],
            'storageConditions' => [
                'При температуре 2–30 °C.',
                'Хранить в недоступном для детей месте.'
            ],
            'shelfLife' => [
                '3 года.',
                'Не применять по истечении срока годности, указанного на упаковке.'
            ]
        ];
        $rls = new Rls();
        $this->assertEquals($result, 
            $rls->parseTradeName('rlsnet/html/tradenames/tn_index_id_70623.htm'));


        $result = [
            'name' => 'Абакавир',
            'forms' => [[
                'code' => 'drugform628',
                'title' => 'таблетки, покрытые пленочной оболочкой (19)'
            ]],
            'mnn' => 'Абакавир* (Abacavirum)',
            'pharmGroups' => [
                'Средства для лечения ВИЧ-инфекции'
            ]
        ];
        $rls = new Rls();
        $this->assertEquals($result, 
            $rls->parseTradeName('rlsnet/html/tradenames/tn_index_id_88051.htm'));


        $result = [
            'name' => 'Абакавира сульфат',
            'forms' => [[
                'code' => 'drugform287',
                'title' => 'субстанция (8)'
            ],[
                'code' => 'drugform528',
                'title' => 'субстанция-порошок (87)'
            ]],
            'mnn' => 'Абакавир* (Abacavirum)',
            'pharmGroups' => [
                'Средства для лечения ВИЧ-инфекции'
            ]
        ];
        $rls = new Rls();
        $this->assertEquals($result, 
            $rls->parseTradeName('rlsnet/html/tradenames/tn_index_id_58420.htm'));


        $result = [
            'name' => 'Абилифай',
            'forms' => [[
                'code' => 'drugform599',
                'title' => 'раствор для внутримышечного введения (1)'
            ],[
                'code' => 'drugform196',
                'title' => 'таблетки (14)'
            ]],
            'mnn' => 'Арипипразол* (Aripiprazolum)',
            'pharmGroups' => [
                'Антипсихотическое средство (нейролептик) [Нейролептики]'
            ],
            'mkbs' => [
                'F20 Шизофрения',
                'F31.2 Биполярное аффективное расстройство, текущий эпизод мании с психотическими симптомами',
                'F31.6 Биполярное аффективное расстройство, текущий эпизод смешанного характера'
            ],
            'composition' => [
                ['Таблетки', '1 табл.'],
                ['арипипразол', '5 мг'],
                ['', '10 мг'],
                ['', '15 мг'],
                ['', '30 мг'],
                ['вспомогательные вещества: лактозы моногидрат; МКЦ; крахмал кукурузный; гидроксипропилцеллюлоза; магния стеарат; краситель железа оксид желтый (таблетки 15 мг); краситель железа оксид красный (таблетки 10 и 30 мг); лак алюминиевый голубой (таблетки 5 мг)', '']
            ],
            'lekForm' => [
                'Таблетки 5 мг: прямоугольные таблетки с закругленными краями, голубого цвета, с маркировкой «А-007» и «5» на одной стороне.',
                'Таблетки 10 мг: прямоугольные таблетки с закругленными краями, розового цвета, с маркировкой «А-008» и «10» на одной стороне.',
                'Таблетки 15 мг: круглые таблетки желтого цвета, с фаской, с маркировкой «А-009» и «15» на одной стороне.',
                'Таблетки 20 мг: круглые таблетки белого или слабо-желтого цвета, с фаской, с маркировкой «А-010» и «20» на одной стороне.',
                'Таблетки 30 мг: круглые таблетки розового цвета, с фаской, с маркировкой «А-011» и «30» на одной стороне.'
            ],
            'pharmEffect' => [
                'Фармакологическое действие - антипсихотическое'
            ],
            'pharmacodynamics' => [
                'Арипипразол обладает высокой аффинностью in vitro к D2 и D3-дофаминовым рецепторам, 5HT1a- и 5HT2a-серотониновым рецепторам и умеренной аффинностью к D4-дофаминовым, 5HT2c- и 5HT7-серотониновым, альфа1-адренорецепторам и H1-гистаминовым рецепторам. Арипипразол характеризуется также умеренной аффинностью к участкам обратного захвата серотонина и отсутствием аффинности к мускариновым рецепторам. Арипипразол в экспериментах на животных проявлял антагонизм в отношении дофаминергической гиперактивности и агонизм в отношении дофаминергической гипоактивности. Взаимодействием не с дофаминовыми и серотониновыми рецепторами можно объяснить некоторые клинические эффекты арипипразола.'
            ],
            'pharmacokinetics' => [
                'Активность Абилифая главным образом обусловлена наличием исходного вещества, арипипразола. Средний период полувыведения арипипразола составляет примерно 75 ч. Равновесная концентрация достигается через 14 дней. Кумуляция препарата при многократном приеме предсказуема. Показатели фармакокинетики арипипразола в равновесном состоянии пропорциональны дозе. Не отмечено суточных колебаний распределения арипипразола и его метаболита дегидроарипипразола. Установлено, что главный метаболит препарата в плазме человека, дегидроарипипразол, обладает такой же аффинностью к D2-дофаминовым рецепторам, как и арипипразол.',
                'Арипипразол быстро всасывается после приема внутрь Абилифая, при этом Cmax препарата в плазме достигается через 3–5 ч. Абсолютная биодоступность таблеток Абилифая составляет 87%. Прием пищи на биодоступность арипипразола не влияет.',
                'Арипипразол интенсивно распределяется в тканях, причем кажущийся объем распределения составляет 4,9 л/кг. При терапевтической концентрации более 99% арипипразола связывается с белками сыворотки, главным образом с альбумином. Арипипразол не влияет на фармакокинетику и фармакодинамику варфарина, т.е. не вытесняет варфарин из связи с белками крови.',
                'Арипипразол подвергается пресистемному метаболизму лишь в минимальной степени. Арипипразол метаболизируется в печени тремя способами: дегидрированием, гидроксилированием и N-дезалкилированием. По данным экспериментов in vitro, дегидрирование и гидроксилирование арипипразола происходит под действием ферментов CYP3A4 и CYP2D6, а N-дезалкилирование катализируется ферментом CYP3A4. Арипипразол является основным компонентом лекарства в крови. При равновесном состоянии AUC дегидроарипипразола составляет примерно 39% от AUC арипипразола в плазме.',
                'После однократного приема меченного 14C-арипипразола примерно 27 и 60% радиоактивности определяется в моче и кале соответственно. Менее 1% неизменного арипипразола определяется в моче и примерно 18% принятой дозы в неизмененном виде выводится с калом. Общий клиренс арипипразола составляет 0,7 мл/мин/кг, главным образом за счет выведения печенью.'
            ],
            'indications' => [
                'острые приступы шизофрении (лечение и поддерживающая терапия);',
                'острые маниакальные эпизоды биполярного расстройства I типа (лечение);',
                'у пациентов с биполярным расстройством I типа, недавно перенесших маниакальный или смешанный эпизод (поддерживающая терапия).'
            ],
            'contraindications' => [
                'повышенная чувствительность к арипипразолу или любому другому компоненту, входящему в состав препарата.',
                'возраст до 18 лет.',
                'С осторожностью:',
                'пациентам с сердечно-сосудистыми заболеваниями (ИБС или перенесенный инфаркт миокарда, сердечная недостаточность и нарушения проводимости);',
                'пациентам с цереброваскулярными заболеваниями и состояниями, предрасполагающими к гипотензии (обезвоживание, гиповолемия и прием гипотензивных препаратов), в связи с возможностью развития ортостатической гипотензии;',
                'пациентам с судорожными припадками или страдающим заболеваниями, при которых возможны судороги;',
                'пациентам с повышенным риском гипертермии, например при интенсивных физических нагрузках, перегревании, приеме антихолинергических препаратов, при обезвоживании (из-за способности нейролептиков нарушать терморегуляцию);',
                'пациентам с повышенным риском аспирационной пневмонии (из-за риска нарушения моторной функции пищевода и аспирации);',
                'пациентам, страдающим ожирением и при наличии диабета в семье.'
            ],
            'pregnancy' => [
                'Адекватных и хорошо контролируемых исследований у беременных женщин не проводилось.',
                'Абилифай может приниматься во время беременности, только если потенциальная польза применения превышает потенциальный риск для плода.',
                'Арипипразол проникает в молоко крыс. Данных о проникновении арипипразола в женское молоко нет. Кормить грудью при применении препарата не рекомендуется.'
            ],
            'sideEffects' => [
                'Частота побочных эффектов приведена в соответствии со следующей шкалой: очень редко — ≤0,01%; редко — ≥0,01% и <0,1%; не часто — ≥0,1% и <1%; часто — ≥1% и <10%; очень часто — ≥10%.',
                'Сердечно-сосудистая система: очень редко — обмороки; редко — вазовагальный синдром, расширение сердца, трепетание предсердий, тромбофлебит, внутричерепное кровоизлияние, ишемия головного мозга; нечасто — брадикардия, сердцебиение, инфаркт миокарда, удлинение QT интервала, остановка сердца, кровоизлияния, фибрилляция предсердий, сердечная недостаточность, AV блокада, ишемия миокарда, тромбоз глубоких вен, флебит, экстрасистолия; часто — ортостатическая гипотензия, тахикардия.',
                'Пищеварительная система: очень редко — повышение активности АЛТ и АСТ; редко — эзофагит, кровоточивость десен, воспаление языка, кровавая рвота, кишечные кровотечения, язва двенадцатиперстной кишки, хейлит, гепатит, увеличение печени, панкреатит, прободение кишечника; иногда — повышение аппетита, гастроэнтерит, затрудненное глотание, метеоризм, гастрит, кариес, гингивит, геморрой, желудочно-пищеводный рефлюкс, желудочно-кишечные кровоизлияния, периодонтальный абсцесс, отек языка, недержание кала, колит, ректальные кровотечения, стоматит, изъязвления во рту, холецистит, фекалома, кандидоз слизистой оболочки рта, желчно-каменная болезнь, отрыжка, язва желудка; часто — диспепсия, рвота, запор; очень часто — тошнота, потеря аппетита.',
                'Иммунная система: очень редко — аллергические реакции (анафилаксия, ангионевротический отек, зуд и крапивница).',
                'Костно-мышечная система: очень редко — увеличение активности креатинфосфокиназы, рабдомиолиз, тендинит, тендобурсит, ревматоидный артрит, миопатия; иногда — боль в суставах и костях, миастения, артрит, артроз, мышечная слабость, спазмы, бурсит; часто — миалгия, судороги.',
                'Нервная система: редко — бред, эйфория, буккоглоссальный синдром, акинезия, угнетение сознания вплоть до потери сознания, сниженные рефлексы, навязчивые мысли, злокачественный нейролептический синдром; нечасто — дистония, мышечные подергивания, ослабление концентрации внимания, парестезия, тремор конечностей, импотенция, брадикинезия, пониженное/повышенное либидо, панические реакции, апатия, дискинезия, ослабление памяти, ступор, амнезия, инсульт, гиперактивность, деперсонализация, дискинезия, синдром «беспокойных ног» (акатизия), миоклонус, подавленное настроение, повышенные рефлексы, замедление мыслительной функции, повышенная чувствительность к раздражителям, гипотония, нарушение глазодвигательной реакции; часто — головокружение, тремор, экстрапирамидный синдром, психомоторное возбуждение, депрессия, нервозность, повышенное слюноотделение, враждебность, суицидальные мысли, маниакальные мысли, нетвердая походка, спутанность сознания, сопротивление выполнению пассивных движений (синдром зубчатого колеса); очень часто — бессонница, сонливость, акатизия.',
                'Дыхательная система: редко — кровохарканье, аспирационная пневмония, усиленное выделение мокроты, сухость слизистой оболочки носа, отек легких, легочная эмболия, гипоксия, дыхательная недостаточность, апноэ; не часто — астма, носовое кровотечение, икота, ларингит; часто — одышка, пневмония.',
                'Кожа и кожные покровы: редко — макулопапулезная сыпь, эксфолиативный дерматит, крапивница; не часто — акне, везикулобулезная (пузырчатая) сыпь, экзема, алопеция (облысение), псориаз, себорея; часто — сухость кожи, зуд, повышенная потливость, кожные изъязвления.',
                'Органы чувств: редко — усиленное слезотечение, частое мигание, наружный отит, амблиопия, глухота, диплопия, глазные кровоизлияния, фотофобия; не часто — сухость глаз, боль в глазах, звон в ушах, воспаление среднего уха, катаракта, потеря вкуса, блефарит; часто — конъюнктивит, боль в ушах.',
                'Мочеполовая система: редко — боли в молочной железе, цервицит, галакторея, аноргазмия, жжение в области мочеполовой системы, глюкозурия, гинекомастия (увеличение молочных желез у мужчин), мочекаменная болезнь, болезненная эрекция; не часто — цистит, учащенное мочеиспускание, лейкорея, задержка мочеиспускания, гематурия, дизурия, аменорея, преждевременная эякуляция, влагалищное кровотечение, вагинальный кандидоз, почечная недостаточность, маточное кровотечение, меноррагия, альбуминурия, камни в почках, никтурия, полиурия, позывы к мочеиспусканию; часто — недержание мочи.',
                'Организм в целом: редко — боли в горле, скованность в спине, тяжесть в голове, кандидоз, скованность в области горла, синдром Мендельсона, тепловой удар; не часто — боли в области таза, отек лица, недомогание, светочувствительность, челюстные боли, озноб, скованность челюстей, вздутие живота, напряжение в груди; часто — гриппоподобный синдром, периферический отек, боли в грудной клетке, в шее.',
                'Метаболические и нарушения, связанные с питанием: редкие — гиперкалиемия, подагра, гипернатриемия, цианоз, закисление мочи, гипогликемическая реакция; не часто — обезвоживание, отек, гиперхолестеринемия, гипергликемия, гипокалиемия, сахарный диабет, повышенный уровень АЛТ, гиперлипидемия, гипогликемия, жажда, повышенное содержание мочевины в крови, гипонатриемия, повышенный уровень АСТ, повышение уровня ЩФ, железодефицитная анемия, повышенный креатинин, билирубинемия, повышенный уровень лактатдегидрогеназы, ожирение; часто — потеря веса, повышение уровня креатинфосфокиназы.'
            ],
            'interaction' => [
                'Не выявлено значимого влияния H2-блокатора гистаминовых рецепторов фамотидина, вызывающего мощное угнетение секреции соляной кислоты в желудке, на фармакокинетику арипипразола.',
                'Известны различные пути метаболизма арипипразола, в т.ч. с участием ферментов CYP2D6 и CYP3A4. В исследованиях у здоровых людей мощные ингибиторы CYP2D6 (хинидин) и CYP3A4 (кетоконазол) уменьшали клиренс арипипразола при приеме внутрь на 52 и 38% соответственно. Поэтому следует уменьшать дозу арипипразола при использовании его в сочетании с ингибиторами CYP3A4 и CYP2D6.',
                'Прием 30 мг арипипразола вместе с карбамазепином, мощным индуктором CYP3A4, сопровождался снижением на 68 и 73% Cmax и AUC арипипразола соответственно, и снижением на 69 и 71% Cmax и AUC его активного метаболита дегидроарипипразола соответственно. Можно ожидать аналогичное действие и других мощных индукторов CYP3A4 и CYP2D6.',
                'В метаболизме арипипразола in vitro не участвуют ферменты CYP1A1, CYP1A2, CYP2A6, CYP2B6, CYP2C8, CYP2C9, CYP2C19 и CYP2E1, в связи с чем маловероятно его взаимодействие с препаратами и другими факторами (например курение), способными ингибировать или активировать эти ферменты.',
                'Одновременный прием лития или вальпроата с 30 мг арипипразола ежедневно не оказал клинически значимого влияния на фармакокинетику арипипразола.',
                'В клинических исследованиях арипипразол в дозах 10–30 мг/сут не оказывал значимого влияния на метаболизм субстратов CYP2D6 (декстрометорфан), CYP2C9 (варфарин), CYP2C19 (омепразол, варфарин) и CYP3A4 (декстрометорфан). Кроме того, арипипразол и его основной метаболит дегидроарипипразол не изменял метаболизм с участием фермента CYP1A2 in vitro. Маловероятно клинически значимое влияние арипипразола на лекарства, метаболизируемые с участием этих ферментов.'
            ],
            'dosing' => [
                'Внутрь, независимо от приема пищи.',
                'Шизофрения: рекомендуется назначать Абилифай в начальной дозе 10 или 15 мг 1 раз в день. Поддерживающая доза составляет 15 мг/сут. В клинических исследованиях показана эффективность препарата в дозах от 10 до 30 мг/сут.',
                'Маниакальные эпизоды при биполярном расстройстве: препарат следует принимать, начиная с дозы 15 или 30 мг/сут. Изменение дозы, при необходимости, надо проводить с интервалом не менее 24 ч. В клинических исследованиях продемонстрирована эффективность препарата в дозах 15–30 мг/сут при маниакальных эпизодах при приеме в течение 3–12 нед. Безопасность доз выше 30 мг/сут в клинических исследованиях не оценивалась.',
                'При наблюдении за пациентами с биполярным расстройством I типа и маниакальными или смешанными эпизодами, у которых не было симптомов на фоне приема Абилифая (15 или 30 мг/сут при начальной дозе — 30 мг/сут) в течение 6 нед, установлен благоприятный эффект такой поддерживающей терапии. Следует периодически обследовать пациентов для определения необходимости продолжения поддерживающей терапии.',
                'Не требуется изменение дозировки препарата при назначении препарата пациентам с почечной недостаточностью, печеночной недостаточностью (класс А, В и С по классификации Чайлд-Пью).',
                'Хотя опыт применения препарата у пациентов в возрасте старше 65 лет ограничен, корректировка дозы для этой категории пациентов не требуется.'
            ],
            'overdose' => [
                'В клинических исследованиях описаны случаи непреднамеренной или умышленной передозировки арипипразола с однократным приемом до 1080 мг, не сопровождавшиеся летальным исходом.',
                'Симптомы: тошнота, рвота, астения, понос и сонливость. У госпитализированных пациентов не выявлены клинически значимые изменения основных физиологических показателей, лабораторных параметров и ЭКГ.',
                'Постмаркетинговый опыт однократного приема взрослыми пациентами до 450 мг арипипразола свидетельствует о возможном развитии тахикардии. Кроме того, описаны случаи передозировки арипипразола у детей (прием до 195 мг). К потенциально опасным симптомам передозировки относятся экстрапирамидные расстройства и преходящая потеря сознания.',
                'При передозировке требуется поддерживающая терапия, обеспечение адекватной проходимости дыхательных путей, оксигенация, эффективная вентиляция легких и симптоматическое лечение. Следует учитывать лекарственные реакции. Немедленно должно быть начато мониторирование показателей работы сердца с регистрацией ЭКГ для выявления аритмий. После подтвержденной или предполагаемой передозировки арипипразола необходимо тщательное медицинское наблюдение до исчезновения всех симптомов.',
                'Активированный уголь (50 г), введенный через 1 ч после приема арипипразола, уменьшал AUC и Cmax арипипразола на 51 и 41% соответственно, что позволяет рекомендовать его применение при передозировке.',
                'Хотя достоверных данных о применении гемодиализа при передозировке арипипразола нет, благоприятный эффект этого метода маловероятен, т.к. арипипразол не выводится почками в неизмененном виде и в значительной мере связывается с белками плазмы.'
            ],
            'specialInstructions' => [
                'Суицидные попытки: склонность к суицидным мыслям и попыткам характерна для психозов, поэтому лекарственная терапия должна сочетаться с тщательным медицинским наблюдением. Абилифай должен выписываться в минимальном количестве, достаточном для лечения пациента; это уменьшит риск передозировки.',
                'Поздняя дискинезия: риск развития поздней дискинезии возрастает по мере увеличения длительности терапии нейролептиками, поэтому при появлении на фоне приема Абилифая симптомов поздней дискинезии следует уменьшить дозу этого препарата или отменить его. После отмены терапии эти симптомы могут временно усилиться или даже впервые появиться.',
                'Злокачественный нейролептический синдром: при лечении нейролептиками, в т.ч. арипипразолом, описан угрожающий жизни симптомокомплекс, известный под названием «злокачественный нейролептический синдром» (ЗНС). Этот синдром проявляется гиперпирексией, мышечной ригидностью, нарушениями психики и нестабильностью вегетативной нервной системы (нерегулярный пульс и АД, тахикардия, потливость и аритмии сердца). Кроме того, иногда возникают увеличение активности креатинфосфокиназы, миоглобинурия (рабдомиолиз) и острая почечная недостаточность. В случае возникновения симптомов ЗНС или необъяснимой лихорадки все нейролептики, в т.ч. Абилифай, должны быть отменены.',
                'Гипергликемия и сахарный диабет: гипергликемия, в некоторых случаях выраженная и связанная с кетоацидозом, которая может привести к гиперосмолярной коме и даже смерти, была отмечена у пациентов, принимавших атипичные нейролептики. Хотя связь между приемом атипичных нейролептиков и нарушениями гипергликемического типа остается неясной, больные, у которых диагностирован сахарный диабет, должны регулярно проводить определение уровня глюкозы в крови при приеме атипичных нейролептиков. Пациенты, у которых присутствуют факторы риска возникновения сахарного диабета (ожирение, наличие диабета в семье) при приеме атипичных нейролептиков должны проводить определение уровня глюкозы в крови в начале курса и периодически в процессе приема препарата. У любых пациентов, принимающих атипичные нейролептики, необходим постоянный мониторинг симптомов гипергликемии, включая усиленную жажду, учащенное мочеиспускание, полифагию, слабость.',
                'Влияние на способность к управлению автомобилем и работе с движущимися механизмами',
                'Как и при назначении других нейролептиков, при назначении арипипразола пациент должен быть предупрежден об опасности работы с движущимися механизмами и управления автомобилем.'
            ],
            'storageConditions' => [
                'В сухом месте, при температуре 15–30 °C.',
                'Хранить в недоступном для детей месте.'
            ],
            'shelfLife' => [
                '3 года.',
                'Не применять по истечении срока годности, указанного на упаковке.'
            ]
        ];
        $rls = new Rls();
        $this->assertEquals($result, 
            $rls->parseTradeName('rlsnet/html/tradenames/tn_index_id_35532.htm'));
    }

    // TODO: Добавить тесты скорости работы методов
}