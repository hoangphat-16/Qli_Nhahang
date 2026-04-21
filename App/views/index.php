<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start('page') ?>


<div class="main-content2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <h2 class="fw-bold mb-3">CHƯƠNG TRÌNH <br> VÀ SỰ KIỆN</h2>
                <p>Các sự kiện & chương trình đặc sắc tại Venus Palace – không gian rooftop sang trọng, tinh tế với tầm nhìn toàn cảnh thành phố tuyệt đẹp. Thưởng thức các màn biểu diễn âm nhạc sống động mang đến bầu không khí thư giãn và dễ chịu.</p>
                <a class="text-white text-decoration-none fw-bold">
                    XEM TOÀN BỘ LỊCH SỰ KIỆN
                </a>
                <hr style="width: 100px; border-top: 3px solid white; opacity: 1;">
            </div>

            <div class="col-lg-8 col-md-12">
                <div id="eventSlider" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card event-card">
                                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=400&q=80"
                                            class="card-img-top" alt="Tiệc Tri Ân">
                                        <div class="card-body">
                                            <h6 class="card-title">TIỆC TRI ÂN</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card event-card">
                                        <img src="https://images.unsplash.com/photo-1524368535928-5b5e00ddc76b?auto=format&fit=crop&w=400&q=80"
                                            class="card-img-top" alt="Sự kiện âm nhạc">
                                        <div class="card-body">
                                            <h6 class="card-title">SỰ KIỆN ÂM NHẠC</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card event-card">
                                        <img src="https://images.unsplash.com/photo-1558008258-3256797b43f3?auto=format&fit=crop&w=400&q=80"
                                            class="card-img-top" alt="Tiệc gia đình">
                                        <div class="card-body">
                                            <h6 class="card-title">TIỆC GIA ĐÌNH</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card event-card">
                                        <img src="https://encrypted-tbn1.gstatic.com/licensed-image?q=tbn:ANd9GcRw8HOorhTKDVcl3zkaqHo4_VEY3-V9LrnbA5qaJWHktNgu5MB7exgPhccIQLGGEBmI9w1Ch_gNuBhb7tALU91HmkcatUY0QV82AKtZdKPuVM4Xr60"
                                            class="card-img-top" alt="Hội nghị">
                                        <div class="card-body">
                                            <h6 class="card-title">HỘI NGHỊ</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card event-card">
                                        <img src="https://encrypted-tbn3.gstatic.com/licensed-image?q=tbn:ANd9GcS-ibzCne2x-LNDDZLbbbibo7AuZLkl5AYLztyMLZBhNlSUtxw656nWj6JV0JefDtXvVflrL0YNGl1XbMELAMOZsoEZduySZL5SdHBykRxAQ-JM8So"
                                            class="card-img-top" alt="Sự kiện ngoài trời">
                                        <div class="card-body">
                                            <h6 class="card-title">NGOÀI TRỜI</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card event-card">
                                        <img src="https://encrypted-tbn3.gstatic.com/licensed-image?q=tbn:ANd9GcQyBcYr613-7a6iXxhZ5WRlfAhiJfLG7io05f_KhZpF54e8l4cGNRM9S25v3Ht-ygMukYdIKj7MPz2l0u6d7s9s4IqSJn0VTdIQCrV74kKGUWSsecU"
                                            class="card-img-top" alt="Tiệc sinh nhật">
                                        <div class="card-body">
                                            <h6 class="card-title">SINH NHẬT</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#eventSlider"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#eventSlider"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="main-content1">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?auto=format&fit=crop&w=900&q=80"
                    class="img-fluid rounded shadow w-50 mx-auto d-block" alt="Restaurant">
            </div>
            <div class="col-md-4">
                <h2 class="text-white mb-3">Ẩm Thực & Không Gian</h2>
                <p class="text-white">Venus Palace mang đến cho bạn trải nghiệm ẩm thực tinh tế với các món ăn Á -
                    Âu được chế biến bởi
                    đầu
                    bếp chuyên nghiệp. Không gian sang trọng, thích hợp cho mọi dịp: gặp gỡ, tiệc tùng hoặc hẹn hò
                    lãng
                    mạn.</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid main-content2">
    <h2 class="text-center text-white mb-4">Món Ăn Nổi Bật</h2>
    <div class="row g-4 justify-content-center">
        <div class="col-md-3">
            <div class="card bg-dark border border-secondary text-light h-100">
                <img src="https://plus.unsplash.com/premium_photo-1663012872761-33dd73e292cc?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1171"
                    class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title white-text">Bít Tết Bò Mỹ</h5>
                    <p class="card-text">Thịt bò Mỹ hảo hạng nướng vừa chín tới, phục vụ cùng sốt tiêu đen đặc
                        trưng.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-dark border border-secondary text-light h-100">
                <img src="https://plus.unsplash.com/premium_photo-1661455803353-f69a605b5105?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                    class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title white-text">Mì Ý Hải Sản</h5>
                    <p class="card-text">Mì Ý tươi xào cùng tôm, mực và nghêu trong nước sốt cà chua đậm đà.</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-dark border border-secondary text-light h-100">
                <img height="240px"
                    src="https://images.unsplash.com/photo-1729542920554-411daacea77b?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                    class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title white-text">Tráng Miệng Dâu Tây</h5>
                    <p class="card-text">Dâu tây tươi với kem vanilla béo ngậy — lựa chọn hoàn hảo kết thúc bữa ăn.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->stop() ?>