<p align="center"><img src="https://fightzone.se/images/footer/fightzone.png"></p>

<p align="center">
<a href="https://github.com/ttrig/fightzone/actions"><img src="https://github.com/ttrig/fightzone/workflows/build/badge.svg" alt="Build Status"></a>
<a href="https://codecov.io/gh/ttrig/fightzone"><img src="https://img.shields.io/codecov/c/github/ttrig/fightzone/master.svg" alt="Codecov"></a>
<a href="https://fightzone.se"><img src="https://img.shields.io/website/https/fightzone.se.svg" alt="Website"></a>
<a href="https://github.com/ttrig/fightzone/blob/master/LICENSE.md"><img src="https://img.shields.io/github/license/ttrig/fightzone.svg" alt="License"></a>
</p>

# Fightzone Malmö

The official homepage of [Fightzone Malmö](https://fightzone.se).


## Quickstart

```shell
composer install
npm install

cp .env.example .env
touch database/database.sqlite

php artisan key:generate
php artisan migrate --seed
php artisan serve
npm run watch
```

## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature-amazing-feature`)
3. Commit your Changes (`git commit -m 'Add AmazingFeature`)
4. Push to the Branch (`git push origin feature-amazing-feature`)
5. Open a Pull Request

## License

fightzone.se is open-sourced software licensed under the [MIT license](./LICENSE.md).
