<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $imageProfile ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= $nameProfile ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- 
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." />
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form-->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'เมนู', 'options' => ['class' => 'header']],
                    ['label' => 'หน้าร้าน', 'icon' => 'home', 'url' => Yii::$app->urlManagerFrontend->createUrl(['site/index'])],
                    ['label' => 'ประเภทสินค้า', 'icon' => 'list', 'url' => ['/category'], 'visible' => Yii::$app->user->can("manageCategory")],
                    ['label' => 'สินค้า', 'icon' => 'barcode', 'url' => ['/product'], 'visible' => Yii::$app->user->can("manageProduct")],
                    ['label' => 'การส่งสินค้า', 'icon' => 'truck', 'url' => ['/tracking'], 'visible' => Yii::$app->user->can("manageTracking")],
                    ['label' => 'การสั่งซื้อ', 'icon' => 'gift', 'url' => ['/orders'], 'visible' => Yii::$app->user->can("manageOrder")],
                    ['label' => 'ลูกค้า', 'icon' => 'users', 'url' => ['/customer'], 'visible' => Yii::$app->user->can("manageCustomer")],
                    ['label' => 'ผู้ใช้', 'icon' => 'user', 'url' => ['/user'], 'visible' => Yii::$app->user->can("manageUser")],
                    ['label' => 'รายงาน', 'options' => ['class' => 'header']],
                    [
                        'label' => 'รายงาน',
                        'icon' => 'file',
                        'url' => '#',
                        'items' => [
                            ['label' => 'ประเภทสินค้า', 'icon' => 'file', 'url' => ['/report/product'],],
                            ['label' => 'สินค้า', 'icon' => 'file', 'url' => ['/report/product'],],
                            ['label' => 'ลูกค้า', 'icon' => 'file', 'url' => ['/report/customer'],],
                            ['label' => 'ส่งสินค้า', 'icon' => 'file', 'url' => ['/report/receive'],],
                            ['label' => 'รับสินค้า', 'icon' => 'file', 'url' => ['/report/delivery'],],
                        ]
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>