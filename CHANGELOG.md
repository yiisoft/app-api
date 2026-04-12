# Yii API template Change Log

## 1.4.1 under development

- no changes in this release.

## 1.4.0 April 12, 2026

- New #275: Add explicit `Caddyfile`s for dev and prod (@samdark)

## 1.3.0 April 06, 2026

- Chg #272: Do not write logs to file since that's not needed for both Docker and `./yii serve` (@samdark)
- Enh #252: Add `.env` for development without Docker (@samdark)
- Enh #271: Add "service update paused" case for swarm deployment log parsing (@samdark)

## 1.2.0 March 09, 2026

- New #263: Improve `prod-deploy` error handling so exact error is printed in case of rollback (@samdark)
- Chg #255: Refactor `Makefile` default command help logic (@samdark)
- Chg #263, #268: Allow symfony/console 8 (@samdark)
- Chg #263: Remove mutation testing (@samdark)
- Chg #265: Refactor `PresenterInterface` and implementations for preparing data only (@vjik)
- Enh #258: Set locale `C.UTF-8` in `Dockerfile` (@vjik)
- Enh #260, #265: Update composer dependencies and refactor to replace use of deprecated classes (@vjik)
- Enh #266: Add grouping to `make` help output (@Xakki, @samdark)
- Bug #256: Fix incorrect .env files used in Docker Compose for production (@aa-chernyh)
- Bug #260: Fix psalm cache directory in configuration file (@vjik)

## 1.1.0 December 22, 2025

- New #248, #249: Add Makefile `stop` goal for stopping Docker containers (@samdark, @vjik)
- Enh #250: Prune unused container and do not detach on `make prod-deploy` (@samdark)
- Enh #254: Add PHP 8.5 support (@vjik)
- Enh #254: Update composer dependencies (@vjik)

## 1.0.0 October 02, 2025

- Initial release.
