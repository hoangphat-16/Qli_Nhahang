<?php $this->layout("layouts/default", ["title" => "Thực đơn"]) ?>

<?php $this->start('page') ?>

<div class="container-fluid main-content3 d-flex align-items-center justify-content-center py-5 mb-4">
    <h1 class="text-white fw-bold">THỰC ĐƠN NHÀ HÀNG</h1>
</div>

<div class="container pb-5">
    <ul class="nav nav-tabs justify-content-center border-warning mb-5" id="menuTab" role="tablist">
        <?php foreach ($categories as $index => $category): ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-warning fs-5 fw-bold <?= $index === 0 ? 'active' : '' ?>"
                    id="tab-<?= $category['category_id'] ?>"
                    data-bs-toggle="tab"
                    data-bs-target="#cat-<?= $category['category_id'] ?>"
                    type="button" role="tab">
                    <?= $this->e($category['category_name']) ?>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="tab-content" id="menuTabContent">
        <?php foreach ($categories as $index => $category): ?>
            <?php $catId = $category['category_id']; ?>

            <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>"
                id="cat-<?= $catId ?>" role="tabpanel">

                <div class="row g-4 justify-content-center">
                    <?php if (isset($dishesByCategory[$catId]) && count($dishesByCategory[$catId]) > 0): ?>
                        <?php foreach ($dishesByCategory[$catId] as $dish): ?>
                            <div class="col-md-6 col-lg-3">
                                <div class="card bg-dark border-secondary h-100 shadow-sm dish-card">
                                    <div style="height: 200px; overflow: hidden;">
                                        <img src="<?= $this->e($dish['image_url'] ?: '/images/default_dish.png') ?>"
                                            class="card-img-top"
                                            alt="<?= $this->e($dish['name']) ?>"
                                            style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;">
                                    </div>

                                    <div class="card-body text-center d-flex flex-column">
                                        <h5 class="card-title text-warning fw-bold"><?= $this->e($dish['name']) ?></h5>

                                        <p class="card-text text-muted small flex-grow-1">
                                            <?= $this->e($dish['description'] ?: 'Món ăn hấp dẫn của Venus Palace') ?>
                                        </p>

                                        <h5 class="text-white mb-3 mt-2">
                                            <?= number_format($dish['price'], 0, ',', '.') ?> VND
                                        </h5>

                                        <a href="/booking" class="btn btn-outline-light btn-sm rounded-pill px-4">
                                            Đặt ngay
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <p class="text-muted fs-5">Chưa có món ăn nào trong danh mục này.</p>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .dish-card:hover img {
        transform: scale(1.1);
    }

    .nav-tabs .nav-link.active {
        background-color: #333 !important;
        border-color: #ffc107 #ffc107 #333;
        color: #ffc107 !important;
    }

    .nav-tabs {
        border-bottom: 1px solid #ffc107;
    }
</style>

<?php $this->stop() ?>