# DevOps101

GitHub Actions CI/CD öğrenmek için hazırlanmış basit bir Laravel todo uygulaması.

## Özellikler

- Todo ekleme, tamamlama ve silme
- PHPUnit feature testleri
- GitHub Actions CI pipeline (push ve PR'da otomatik test)

## Lokal çalıştırma

```bash
cd devops101
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Tarayıcıda: http://127.0.0.1:8000

## Testleri çalıştırma

```bash
php artisan test
```

## GitHub'a yükleme

```bash
git init
git add .
git commit -m "Initial commit: DevOps101 todo app with CI"
git branch -M main
git remote add origin https://github.com/KULLANICI_ADIN/devops101.git
git push -u origin main
```

Push sonrası GitHub repo sayfasında **Actions** sekmesinden CI sonucunu izleyebilirsin.

## CI pipeline'ı test etme

1. Bir branch aç: `git checkout -b feature/ci-test`
2. Küçük bir değişiklik yap (ör. README'ye satır ekle)
3. Push et ve PR aç
4. Actions sekmesinde testlerin çalıştığını gör
5. Bilerek failing test yaz → pipeline kırmızı olur
6. Düzelt → yeşil olur

## Proje yapısı

```
app/Models/Todo.php
app/Http/Controllers/TodoController.php
tests/Feature/TodoTest.php
.github/workflows/ci.yml
```
