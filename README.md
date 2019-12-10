# jd_union
京东客、京东联盟、京东API

工厂类

    namespace app\common\factory;
    use mengsen\jd\TopClient;

    class Jd
    {
        private static $obj = null;
        public static function getInstance()
        {
            if (self::$obj == null) {
                $conf = config('jd.union');
                $app = new TopClient($conf['appkey'], $conf['secretKey']);
                self::$obj = $app;
            }
            return self::$obj;
        }
    }


DEMO

    $app = Jindong::getInstance();
    $res = $app->execute('jd.union.open.promotion.common.get', [
        'promotionCodeReq' => [
            'siteId' => '1937243904',
            'materialId' => $param['material_id'],
            // 'ext1' => 'h5'
        ],
    ]);
