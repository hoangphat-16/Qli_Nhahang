<?php $this->layout("layouts/default", ["title" => APPNAME]) ?>

<?php $this->start('page') ?>

<div class="container-fluid text-center text-white main-content3 py-5">
    <div class="container">
        <h2 class="display-4 fw-bold mb-4">BOOK A TABLE</h2>

        <div id="bookingAlert"></div>

        <form id="bookingForm" method="POST" action="/booking">
            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" name="phone" id="phone" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="guests" class="form-label">Guests</label>
                    <input type="number" name="guests" id="guests" class="form-control" min="1" required>
                </div>
                <div class="col-md-4">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="time" class="form-label">Time</label>
                    <input type="time" name="time" id="time" class="form-control" required>
                </div>
            </div>

            <div class="row justify-content-center g-4 mb-4">
                <div class="col-lg-10 text-start">
                    <label class="form-label fs-5 mb-3">Chọn Món Đặt Trước (Không bắt buộc, nếu món chưa gặp vấn đề tôi sẽ liên lạc với bạn qua số điện thoại)</label>

                    <?php if (empty($dishes)): ?>
                        <p class="text-muted">Chưa có món</p>
                    <?php else: ?>
                        <div class="accordion" id="menuAccordion">
                            <?php foreach ($categories as $category): ?>
                                <div class="accordion-item mb-3">
                                    <h2 class="accordion-header" id="heading<?= $category['category_id'] ?>">
                                        <button class="accordion-button <?= $category['category_id'] == 1 ? '' : 'collapsed' ?>"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse<?= $category['category_id'] ?>"
                                            aria-expanded="<?= $category['category_id'] == 1 ? 'true' : 'false' ?>"
                                            aria-controls="collapse<?= $category['category_id'] ?>">
                                            <?= htmlspecialchars($category['category_name']) ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $category['category_id'] ?>"
                                        class="accordion-collapse collapse <?= $category['category_id'] == 1 ? 'show' : '' ?>"
                                        aria-labelledby="heading<?= $category['category_id'] ?>"
                                        data-bs-parent="#menuAccordion">
                                        <div class="accordion-body">
                                            <?php foreach ($dishes as $dish): ?>
                                                <?php if (isset($dish['category_id']) && $dish['category_id'] == $category['category_id']): ?>
                                                    <div class="d-flex align-items-center mb-3 p-3 bg-dark rounded shadow-sm dish-item"
                                                        style="transition: transform 0.2s; cursor:pointer;">
                                                        <img src="<?= htmlspecialchars($dish['image_url']) ?>"
                                                            alt="<?= htmlspecialchars($dish['name']) ?>"
                                                            class="rounded me-3"
                                                            style="width:100px; height:100px; object-fit:cover;">
                                                        <div class="flex-grow-1">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="dishes[]" value="<?= htmlspecialchars($dish['dish_id']) ?>"
                                                                    id="dish<?= $dish['dish_id'] ?>">
                                                                <label class="form-check-label fw-bold" for="dish<?= $dish['dish_id'] ?>">
                                                                    <?= htmlspecialchars($dish['name']) ?>
                                                                    <span class="badge bg-warning text-dark"><?= number_format($dish['price']) ?> VND</span>
                                                                    <?php if (!empty($dish['description'])): ?>
                                                                        <br><small><?= htmlspecialchars($dish['description']) ?></small>
                                                                    <?php endif; ?>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="mt-3">
                        <label for="other_requests" class="form-label">Yêu cầu khác:</label>
                        <textarea class="form-control" name="other_requests" id="other_requests" rows="3"
                            placeholder="Ví dụ: 1 phần gỏi tôm, 2 súp cua..."></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-light py-3 px-5 fw-bold mb-3">
                BOOK NOW
            </button>
        </form>
    </div>
</div>
<hr class="my-5 text-white">

<script>
    document.querySelectorAll('.dish-item').forEach(item => {
        item.addEventListener('mouseenter', () => item.style.transform = 'scale(1.02)');
        item.addEventListener('mouseleave', () => item.style.transform = 'scale(1)');
    });


    document.getElementById('bookingForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(res => res.json())
            .then(data => {
                const alertDiv = document.getElementById('bookingAlert');
                alertDiv.innerHTML = `<div class="alert alert-${data.success ? 'success' : 'danger'}">
                                        ${data.message}
                                      </div>`;
                if (data.success) {
                    form.reset();

                }
            })
            .catch(err => {
                console.error(err);
                document.getElementById('bookingAlert').innerHTML =
                    `<div class="alert alert-danger">Có lỗi xảy ra. Vui lòng thử lại.</div>`;
            });
    });
</script>

<?php $this->stop() ?>