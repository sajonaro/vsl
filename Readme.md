## TL/DR;

this is a HELLO-WORLD application based on SLIM ( https://www.slimframework.com/) and vsl (https://github.com/sajonaro/vsl)


## quick 101

- to run application 

```
docker compose up -d
```
then open it in browser via localhost:8099

- alternatively ( install httpie cli tool for that one)

```
http get http://localhost:8099
http get http://localhost:8099/api/products
http get http://localhost:8099/api/products/1

```

- to restore packages (dependencies)
```
 docker compose run --rm composer update
```

- to run without docker 

```
php -S localhost:8099 -t code/public
```