## SSL acma-companion
 - https://github.com/nginx-proxy/acme-companion/blob/main/docs/Container-utilities.md
 - Renew SSL (Prod)
```shell
docker-compose -f docker-compose.prod.yml exec acme-companion /app/force_renew
```
