# Deploy — adespeedshop (admparts.store)

CodeIgniter 4 di Hostinger. Tarik kode dari GitHub via SSH, lalu sync folder publik.

## Lokasi penting
- **App + Git repo:** `~/adespeedshop-app` (tempat deploy dijalankan)
- **Docroot live:** `~/domains/admparts.store/public_html`
- **Domain:** https://admparts.store/ · **Branch:** `master`
- ⚠️ Jangan sentuh `~/public_html` — itu folder/domain lain.

## Langkah deploy
```bash
# 1. Di lokal: push dulu ke GitHub
git push origin master

# 2. SSH ke Hostinger, lalu:
cd ~/adespeedshop-app
git status            # pastikan bersih (tidak ada edit manual di server)
./deploy.sh           # otomatis: pull → composer → migrate → sync public/
```
`deploy.sh` sudah termasuk `git pull`, jadi **tidak perlu pull manual**.
Pastikan perubahan sudah di-`push` ke GitHub sebelum deploy.

## Verifikasi
Buka https://admparts.store/ (hard refresh `Ctrl+Shift+R` biar lepas cache).

## Kalau bermasalah
- **Pull konflik** → ada file diedit langsung di server; cek `git status`.
- **Perubahan tak muncul** → lupa `git push`, atau cache browser.
- **Website error** → cek log di `~/adespeedshop-app/writable/logs/`.
