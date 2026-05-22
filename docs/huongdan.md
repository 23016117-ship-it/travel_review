# Huong dan tong quan du an Travel Review (danh cho nguoi moi)

Tai lieu nay giai thich cau truc thu muc va chuc nang cac file chinh trong du an, theo ngon ngu de hieu cho nguoi moi bat dau voi Laravel.

## 1. Tong quan nhanh ve Laravel
Laravel la framework PHP theo mo hinh MVC:
- **Model**: quan ly du lieu va tuong tac CSDL.
- **View**: giao dien (file Blade).
- **Controller**: xu ly logic, nhan request va tra ve view.

Du an Travel Review chia thanh 2 phan:
- **User**: nguoi dung xem dia diem, review, rating, comment, favorites.
- **Admin**: quan tri dia diem, review, comment, user va thong ke.

## 2. Cac thu muc chinh
### 2.1. app/
Noi chua logic chinh cua he thong.
- **Http/Controllers/**: controller xu ly logic.
- **Http/Requests/**: validate du lieu dau vao.
- **Models/**: dinh nghia bang du lieu.
- **Providers/**: cac service cua Laravel.

### 2.2. routes/
Noi khai bao cac duong dan (URL) cua he thong.
- **web.php**: route chinh cho user va admin.
- **auth.php**: route dang nhap, dang ky.

### 2.3. resources/views/
Chua giao dien (Blade).
- **layouts/**: khung giao dien chung (user, admin, guest).
- **auth/**: giao dien dang nhap/dang ky.
- **locations/**: giao dien danh sach va chi tiet dia diem.
- **reviews/**: giao dien viet review.
- **admin/**: giao dien cho quan tri vien.

### 2.4. database/
Chua migration va seeder.
- **migrations/**: tao bang du lieu.
- **seeders/**: du lieu mau.

### 2.5. public/
Tai nguyen public (css, images, build).
- **css/app.css**: toan bo style UI.
- **images/**: hinh anh dung cho giao dien.

## 3. Cac file quan trong va chuc nang
### 3.1. Routes
**routes/web.php**
- Trang chu va danh sach dia diem: `Route::get('/', LocationController@index)`.
- Chi tiet dia diem: `Route::get('/locations/{location}')`.
- Nhom route user da dang nhap: review, rating, comment, favorites, profile.
- Nhom route admin: dashboard, locations, reviews, comments, users.

**routes/auth.php**
- Dang nhap, dang ky, dang xuat.
- Da loai bo: reset mat khau, verify email.

### 3.2. Controllers (app/Http/Controllers)
**LocationController**
- Hien thi danh sach dia diem (index).
- Hien thi chi tiet dia diem (show).

**ReviewController**
- Hien thi form viet review (create).
- Luu review (store).

**RatingController**
- Luu diem danh gia sao va cap nhat avg_rating.

**CommentController**
- Luu binh luan cho review.

**FavoriteController**
- Toggle them/xoa dia diem yeu thich.
- Hien thi danh sach yeu thich.

**ProfileController**
- Form cap nhat thong tin user (name/email).
- Xoa tai khoan.

**Admin Controllers** (app/Http/Controllers/Admin)
- **DashboardController**: thong ke tong quan va bieu do reviews.
- **LocationController**: CRUD dia diem.
- **ReviewController**: duyet/tu choi/xoa review.
- **CommentController**: duyet/tu choi/xoa comment.
- **UserController**: quan ly user, khoa/mo khoa, doi mat khau cho user.

### 3.3. Models (app/Models)
**User**
- Thuoc tinh: name, email, password, role, is_active.
- Quan he: reviews, ratings, comments, favorites.

**Location**
- Thuoc tinh: name, slug, description, address, region, category, image, avg_rating.
- Quan he: reviews, ratings, favorites.

**Review**
- Thuoc tinh: title, content, status, user_id, location_id.
- Quan he: comments, user, location.

**Rating**
- Thuoc tinh: score, comment, user_id, location_id.

**Comment**
- Thuoc tinh: content, status, user_id, review_id.

**Favorite**
- Quan he giua user va location.

### 3.4. Views (resources/views)
**layouts/app.blade.php**
- Khung giao dien user (header, menu, content).

**layouts/admin.blade.php**
- Khung giao dien admin voi sidebar ben trai.

**layouts/guest.blade.php**
- Khung giao dien auth (dang nhap/dang ky), co hinh nen.

**auth/login.blade.php**
- Form dang nhap, co icon mat hien/an mat khau.

**auth/register.blade.php**
- Form dang ky, co icon mat hien/an mat khau.

**locations/index.blade.php**
- Danh sach dia diem theo card UI.

**locations/show.blade.php**
- Chi tiet dia diem, ratings, reviews, comments.

**reviews/create.blade.php**
- Form viet review (da bo upload anh).

**admin/**
- Dashboard, locations, users, comments, reviews cho admin.

### 3.5. CSS (public/css/app.css)
- Toan bo style cho header user, card dia diem, auth, admin sidebar, nut action.
- Da custom theo mau: brand mau xanh, font Pacifico, card dia diem theo mau thiet ke.

## 4. Luong hoat dong chinh
1. Nguoi dung vao trang chu -> xem danh sach dia diem.
2. Click vao dia diem -> xem chi tiet, review va comment.
3. Nguoi dung dang nhap -> co the viet review, danh gia, binh luan.
4. Admin dang nhap -> quan ly dia diem, duyet review/comment, quan ly user.

## 5. Cac thay doi quan trong trong du an
- Tat reset mat khau va email verify.
- Bo avatar trong profile.
- Giao dien card dia diem theo mau.
- Admin sidebar ben trai, nut action dep va gon.

## 6. Goi y cho nguoi moi
- Doc file routes/web.php de hieu luong chinh.
- Doc controllers de biet logic xu ly.
- Doc views de hieu UI.
- Doc models de hieu CSDL.

Neu can them phan use case, ERD, hoac huong dan deploy, hay noi de bo sung.
