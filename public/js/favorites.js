document.addEventListener('DOMContentLoaded', function () {
    // جلب العناصر من الصفحات بناءً على الكلاسات والمعرفات الجديدة
    const favoriteTrigger = document.querySelector('.favorite-trigger');
    const favoritesSidebar = document.getElementById('favoritesSidebar');
    const closeSidebarBtn = document.querySelector('.close-sidebar-btn');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    
    const majorsList = document.getElementById('sidebarFavMajors');
    const universitiesList = document.getElementById('sidebarFavUniversities');
    const favCountBadge = document.querySelector('.count_favourite');

    // دالة مساعدة لجلب الـ CSRF Token بأمان دون التسبب في انهيار الكود لو اختفى من الصفحة
    function getCsrfToken() {
        const tokenElement = document.querySelector('meta[name="csrf-token"]');
        return tokenElement ? tokenElement.getAttribute('content') : '';
    }

    // 1. دالة لفتح القائمة الجانبية وجلب البيانات
    if (favoriteTrigger) {
        favoriteTrigger.addEventListener('click', function (e) {
            e.preventDefault(); // منع الرابط الافتراضي من الانتقال
            
            // فتح القائمة الجانبية وعرض الخلفية المظلمة
            if (favoritesSidebar) favoritesSidebar.classList.add('open');
            if (sidebarOverlay) sidebarOverlay.classList.add('show');            
            // استدعاء دالة جلب البيانات لتحديث القائمة فوراً
            fetchFavoritesFromServer();
        });
    }

    // 2. دالة إغلاق القائمة الجانبية (عند الضغط على X أو الخلفية المظلمة)
    function closeSidebar() {
        if (favoritesSidebar) favoritesSidebar.classList.remove('open');
        if (sidebarOverlay) sidebarOverlay.classList.remove('show');
    }

    if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', closeSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

    // 3. دالة جلب البيانات من لارافيل عبر الفيتش (Fetch API)
    function fetchFavoritesFromServer() {
        fetch('/api/user/favorites', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken() // استخدام الدالة الآمنة لـ الـ Token
            }
        })
        .then(response => response.json())
        .then(data => {
            // تحديث عداد الأيقونة الأحمر (الرقم فوق القلب)
            if (favCountBadge) {
                favCountBadge.textContent = data.total_count;
            }
            // 🌟 ب: تحديث العداد الداخلي للسايدبار بجانب كلمة (Beğenilenler)
            const sidebarTotalBadge = document.querySelector('.sidebar-total-count');
            if (sidebarTotalBadge) {
                sidebarTotalBadge.textContent = data.total_count;
            }

            //  ج: تحديث قائمة التخصصات داخل الـ Sidebar وتحويلها لكروت
            if (majorsList) {
                majorsList.innerHTML = '';
                if (!data.majors || data.majors.length === 0) {
                    majorsList.innerHTML = '<p class="text-center text-muted small">Henüz bölüm eklenmedi.</p>';
                } else {
                    data.majors.forEach(major => {
                        majorsList.innerHTML += `
                            <div class="card shadow-lg mb-3">
                                <div class="card-body text-center p-3">
                                    <h6 class="mini-cart-title" title="${major.name}">${major.name}</h6>
                                    <div class="mt-2 d-flex justify-content-center align-items-center">
                                        <a href="/major-details/${major.id}" class="btn btn-warning py-1 px-3">
                                            Detayları Gör
                                        </a>
                                        <button class="btn-card-favorite active" data-id="${major.id}" data-type="major">
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                }
            }
            // د: بناء كروت الجامعات المفضلة بنفس كلاسات وتصميم كروت صفحة الجامعات
            if (universitiesList) {
                universitiesList.innerHTML = '';
                if (!data.universities || data.universities.length === 0) {
                    universitiesList.innerHTML = '<p class="text-center text-muted small">Kayıtlı üniversite bulunamadı.</p>';
                } else {
                    data.universities.forEach(uni => {
                        universitiesList.innerHTML += `
                            <div class="card shadow-lg mb-3">
                                <div class="card-body text-center p-3">
                                    <h6 class="mini-cart-title" title="${uni.name}">${uni.name}</h6>
                                    <div class="mt-2 d-flex justify-content-center align-items-center">
                                        <a href="/university-details/${uni.id}" class="btn btn-warning py-1 px-3">
                                            Detayları Gör
                                        </a>
                                        <button class="btn-card-favorite active" data-id="${uni.id}" data-type="university">
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                }
            }
        })
        .catch(error => console.error('فشل في تحديث قائمة المفضلة:', error));
    }

    // 4. 🌟 مراقبة الضغط على أزرار القلوب الموجودة على الكروت (التخصصات والجامعات)
    // نستخدم الـ Event Delegation لكي يلقط الأزرار حتى لو جاءت بالبحث لاحقاً
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.btn-card-favorite'); // تم التحديث للكلاس الجديد الموحد
        if (!btn) return;

        e.preventDefault();
        
        const majorId = btn.dataset.id && btn.dataset.type === 'major' ? btn.dataset.id : null;
        const universityId = btn.dataset.id && btn.dataset.type === 'university' ? btn.dataset.id : null;
        const icon = btn.querySelector('i');

        // إرسال طلب التبديل للسيرفر
        fetch('/favorite/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken() // استخدام الدالة الآمنة لـ الـ Token
            },
            body: JSON.stringify({ major_id: majorId, university_id: universityId })
        })
        .then(response => {
            // 🌟 إذا رجع السيرفر كود 401 (يعني المستخدم زائر وليس مسجل دخول)
            if (response.status === 401) {
                return response.json().then(data => {
                    // إظهار التنبيه للمستخدم مباشرة وحظر العملية
                    alert(data.message || "Lütfen önce giriş yapın.");
                    throw new Error('User not logged in');
                });
            }
            return response.json();
        })
        .then(data => {
            if (icon) {
                if (data.status === 'added') {
                    icon.classList.replace('fa-regular', 'fa-solid'); // قلب ممتلئ
                    btn.classList.add('active');
                } else if (data.status === 'removed') {
                    icon.classList.replace('fa-solid', 'fa-regular'); // قلب فارغ
                    btn.classList.remove('active');
                }
            }
            // تحديث العداد والسايدبار فوراً ليظهر العنصر الجديد
            fetchFavoritesFromServer();
        })
        .catch(error => console.log('تعامل المفضلة:', error.message));
    });

    // استدعاء أولي لتحديث العداد عند فتح الصفحة لأول مرة
    fetchFavoritesFromServer();
});