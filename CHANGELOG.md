# Yii API template Change Log

## 1.1.1 under development

- New #263: Improve `prod-deploy` error handling so exact error is printed in case of rollback (@samdark)
- Chg #263: Remove mutation testing (@samdark)
- Chg #263: Allow symfony/console 8 (@samdark)
- Chg #255: Refactor `Makefile` default command help logic (@samdark)
- Bug #256: Fix incorrect .env files used in Docker Compose for production (@aa-chernyh)
- Enh #258: Set locale `C.UTF-8` in `Dockerfile` (@vjik)
- Bug #260: Fix psalm cache directory in configuration file (@vjik)
- Enh #260: Update composer dependencies (@vjik)

## 1.1.0 December 22, 2025

- New #248, #249: Add Makefile `stop` goal for stopping Docker containers (@samdark, @vjik)
- Enh #250: Prune unused container and do not detach on `make prod-deploy` (@samdark)
- Enh #254: Add PHP 8.5 support (@vjik)
- Enh #254: Update composer dependencies (@vjik)

## 1.0.0 October 02, 2025

- Initial release.
