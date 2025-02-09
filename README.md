# Order Service

Bu servis, sipariş işlemlerini yönetmek için tasarlanmış bir mikroservistir.

## 🚀 Başlangıç

### Gereksinimler

- Docker
- Docker Compose
- Redis
- RabbitMQ

### Kurulum

1. Projeyi klonlayın
```bash
git clone https://github.com/my-microservice-project/order-service
```

2. Proje dizinine gidin
```bash
cd order-service
```

3. .env dosyasını oluşturun
```bash
cp .env.example .env
```

4. Kaynak kod dizinine gidin
```bash
cd src/
```

5. .env dosyasını oluşturun
```bash
cp .env.example .env
```

6. Ana dizinine gidin ve Docker Compose ile servisi başlatın
```bash
cd .. && docker-compose up -d
```

7. Container içerisine girin
```bash
docker exec -it phpserver_order_service
```
8. Composer ile bağımlılıkları yükleyin
```bash
composer install
```

## 📝 Notlar

- Swagger dökümantasyonu için [http://localhost:8085/api/documentation](http://localhost:8085/api/documentation) adresini ziyaret edebilirsiniz.
