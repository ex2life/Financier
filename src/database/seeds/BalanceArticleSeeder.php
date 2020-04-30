<?php

use App\BalanceArticle;
use Illuminate\Database\Seeder;

class BalanceArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1110',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Нематериальные активы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11101',
            'has_children'=>False,
            'parent_code'=>'1110',
            'description'=>'Нематериальные активы в организации',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11102',
            'has_children'=>False,
            'parent_code'=>'1110',
            'description'=>'Приобретение нематериальных активов',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1120',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Результаты исследований и разработок',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11201',
            'has_children'=>False,
            'parent_code'=>'1120',
            'description'=>'Расходы на научно-исследовательские, опытно-конструкторские и технологические работы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11202',
            'has_children'=>False,
            'parent_code'=>'1120',
            'description'=>'Выполнение научно-исследовательских, опытно-конструкторских и технологических работ',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1130',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Нематериальные поисковые активы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1140',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Материальные поисковые активы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1150',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Основные средства',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11501',
            'has_children'=>False,
            'parent_code'=>'1150',
            'description'=>'Основные средства в организации',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11502',
            'has_children'=>False,
            'parent_code'=>'1150',
            'description'=>'Объекты недвижимости, права собственности на которые не зарегистрированы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11503',
            'has_children'=>False,
            'parent_code'=>'1150',
            'description'=>'Оборудование к установке',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11504',
            'has_children'=>False,
            'parent_code'=>'1150',
            'description'=>'Приобретение земельных участков',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11505',
            'has_children'=>False,
            'parent_code'=>'1150',
            'description'=>'Приобретение объектов природопользования',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11506',
            'has_children'=>False,
            'parent_code'=>'1150',
            'description'=>'Строительство объектов основных средств',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11507',
            'has_children'=>False,
            'parent_code'=>'1150',
            'description'=>'Приобретение объектов основных средств',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11508',
            'has_children'=>False,
            'parent_code'=>'1150',
            'description'=>'Расходы будущих периодов',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11509',
            'has_children'=>False,
            'parent_code'=>'1150',
            'description'=>'Арендованное имущество',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1160',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Доходные вложения в материальные ценности',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11601',
            'has_children'=>False,
            'parent_code'=>'1160',
            'description'=>'Материальные ценности в организации',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11602',
            'has_children'=>False,
            'parent_code'=>'1160',
            'description'=>'Материальные ценности предоставленные во временное владение и пользование',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11603',
            'has_children'=>False,
            'parent_code'=>'1160',
            'description'=>'Материальные ценности предоставленные во временное пользование',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11604',
            'has_children'=>False,
            'parent_code'=>'1160',
            'description'=>'Прочие доходные вложения',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1170',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Финансовые вложения',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1180',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Отложенные налоговые активы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1190',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Прочие внеоборотные активы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11901',
            'has_children'=>False,
            'parent_code'=>'1190',
            'description'=>'Перевод молодняка животных в основное стадо',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11902',
            'has_children'=>False,
            'parent_code'=>'1190',
            'description'=>'Приобретение взрослых животных',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'11903',
            'has_children'=>False,
            'parent_code'=>'1190',
            'description'=>'Расходы будущих периодов',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'11',
            'code'=>'1100',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Итого по разделу I',
            'is_sum_section'=>True,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'1210',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Запасы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12101',
            'has_children'=>False,
            'parent_code'=>'1210',
            'description'=>'Материалы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12102',
            'has_children'=>False,
            'parent_code'=>'1210',
            'description'=>'Товары',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12103',
            'has_children'=>False,
            'parent_code'=>'1210',
            'description'=>'Готовая продукция',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'1220',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Налог на добавленную стоимость по приобретенным ценностям',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'1230',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Дебиторская задолженность',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12301',
            'has_children'=>False,
            'parent_code'=>'1230',
            'description'=>'Расчеты с поставщиками и подрядчиками',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12302',
            'has_children'=>False,
            'parent_code'=>'1230',
            'description'=>'Расчеты с покупателями и заказчиками',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12303',
            'has_children'=>False,
            'parent_code'=>'1230',
            'description'=>'Расчеты с подотчетными лицами',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12304',
            'has_children'=>False,
            'parent_code'=>'1230',
            'description'=>'Расчеты с персоналом по прочим операциям',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12305',
            'has_children'=>False,
            'parent_code'=>'1230',
            'description'=>'Расчеты с разными дебиторами и кредиторами',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12306',
            'has_children'=>False,
            'parent_code'=>'1230',
            'description'=>'Расходы будущих периодов',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12307',
            'has_children'=>False,
            'parent_code'=>'1230',
            'description'=>'Оценочные обязательства',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'1240',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Финансовые вложения (за исключением денежных эквивалентов)',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'1250',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Денежные средства и денежные эквиваленты',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12501',
            'has_children'=>False,
            'parent_code'=>'1250',
            'description'=>'Касса организации',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'12502',
            'has_children'=>False,
            'parent_code'=>'1250',
            'description'=>'Расчетные счета',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'1260',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Прочие оборотные активы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'12',
            'code'=>'1200',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Итого по разделу II',
            'is_sum_section'=>True,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>False,
            'section_code'=>'16',
            'code'=>'1600',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'БАЛАНС',
            'is_sum_section'=>False,
            'is_sum_part'=>1
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'13',
            'code'=>'1310',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Уставный капитал (складочный капитал, уставный фонд, вклады товарищей)',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'13',
            'code'=>'1320',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Собственные акции, выкупленные у акционеров',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'13',
            'code'=>'1340',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Переоценка внеоборотных активов',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'13',
            'code'=>'1350',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Добавочный капитал (без переоценки)',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'13',
            'code'=>'1360',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Резервный капитал',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'13',
            'code'=>'1370',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Нераспределенная прибыль (непокрытый убыток)',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'13',
            'code'=>'1300',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Итого по разделу III',
            'is_sum_section'=>True,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'14',
            'code'=>'1410',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Заемные средства',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'14',
            'code'=>'1420',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Отложенные налоговые обязательства',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'14',
            'code'=>'1430',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Оценочные обязательства',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'14',
            'code'=>'1450',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Прочие обязательства',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'14',
            'code'=>'1400',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Итого по разделу IV',
            'is_sum_section'=>True,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'1510',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Заемные средства',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15101',
            'has_children'=>False,
            'parent_code'=>'1510',
            'description'=>'Краткосрочные займы',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15102',
            'has_children'=>False,
            'parent_code'=>'1510',
            'description'=>'Проценты по краткосрочным займам',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'1520',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Кредиторская задолженность',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15201',
            'has_children'=>False,
            'parent_code'=>'1520',
            'description'=>'Расчеты с поставщиками и подрядчиками',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15202',
            'has_children'=>False,
            'parent_code'=>'1520',
            'description'=>'Расчеты с покупателями и заказчиками',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15203',
            'has_children'=>False,
            'parent_code'=>'1520',
            'description'=>'Расчеты по налогам и сборам',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15204',
            'has_children'=>False,
            'parent_code'=>'1520',
            'description'=>'Расчеты по социальному страхованию и обеспечению',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15205',
            'has_children'=>False,
            'parent_code'=>'1520',
            'description'=>'Расчеты с персоналом по оплате труда',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15206',
            'has_children'=>False,
            'parent_code'=>'1520',
            'description'=>'Расчеты с подотчетными лицами',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15207',
            'has_children'=>False,
            'parent_code'=>'1520',
            'description'=>'Расчеты с персоналом по прочим операциям',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15208',
            'has_children'=>False,
            'parent_code'=>'1520',
            'description'=>'Задолженность участникам (учредителям) по выплате доходов',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15209',
            'has_children'=>False,
            'parent_code'=>'1520',
            'description'=>'Расчеты с разными дебиторами и кредиторами',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'1530',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Доходы будущих периодов',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'1540',
            'has_children'=>True,
            'parent_code'=>'0',
            'description'=>'Оценочные обязательства',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15401',
            'has_children'=>False,
            'parent_code'=>'1540',
            'description'=>'Оценочные обязательства по вознаграждениям работников',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'15402',
            'has_children'=>False,
            'parent_code'=>'1540',
            'description'=>'Резервы предстоящих расходов прочие',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'1550',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Прочие обязательства',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'15',
            'code'=>'1500',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'Итого по разделу V',
            'is_sum_section'=>True,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>False,
            'section_code'=>'17',
            'code'=>'1700',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'БАЛАНС',
            'is_sum_section'=>False,
            'is_sum_part'=>1
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>True,
            'section_code'=>'11',
            'code'=>'11',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'I. ВНЕОБОРОТНЫЕ АКТИВЫ',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>True,
            'is_section'=>True,
            'section_code'=>'12',
            'code'=>'12',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'II. ОБОРОТНЫЕ АКТИВЫ',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>True,
            'section_code'=>'13',
            'code'=>'13',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'III. КАПИТАЛ И РЕЗЕРВЫ',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>True,
            'section_code'=>'14',
            'code'=>'14',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'IV. ДОЛГОСРОЧНЫЕ ОБЯЗАТЕЛЬСТВА',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );



        BalanceArticle::create( [
            'balance_part'=>False,
            'is_section'=>True,
            'section_code'=>'15',
            'code'=>'15',
            'has_children'=>False,
            'parent_code'=>'0',
            'description'=>'V. КРАТКОСРОЧНЫЕ ОБЯЗАТЕЛЬСТВА',
            'is_sum_section'=>False,
            'is_sum_part'=>0
        ] );


    }
}
