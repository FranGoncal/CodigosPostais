# Guia para o Deployment do Container Frontend em Azure
```sh
Exemplo de <oTeuRegistry> registocodigopostal.azurecr.io
```

```sh
NOTA: É necessário levantar primeiro o backend para descobrir o IP ou FQDN desse container, sendo necessária a substituição de "<FQDN>" na linha 57 do index.html
```

## 1-Construir Imagem:
```sh
    docker build -t frontend-codigos:1.0 .
```
## (Opcional)-Testar Imagem Localmente:
```sh
    docker run -p 8081:80 frontend-codigos:1.0
```
## 2-Disponibilizar no Azure Registry:
```sh
    docker login <oTeuRegistry>

    docker tag frontend-codigos:1.0 <oTeuRegistry>/frontend-codigos:1.0

    docker push <oTeuRegistry>/frontend-codigos:1.0
```

## 3-Aceder ao Serviço:
```sh
    http://<IP>/
    ou
    http://<FQDN>/
```