# Guia para o Deployment do Container Backend em Azure

```sh
Exemplo de <oTeuRegistry> registocodigopostal.azurecr.io
```

## 1-Construir Imagem
```sh
    docker build -t codigo-postal:1.0 .
```
## (Opcional)-Testar Imagem Localmente:
```sh
    docker run -p 8081:80 codigo-postal:1.0
```
## 2-Disponibilizar no Azure Registry:
```sh
    docker login <oTeuRegistry>

    docker tag codigo-postal:1.0 <oTeuRegistry>/codigo-postal:1.0

    docker push <oTeuRegistry>/codigo-postal:1.0
```

## 3-Aceder ao Serviço:
```sh
    http://<IP>/?num_cod_postal=1000&ext_cod_postal=001
    ou
    http://<FQDN>/?num_cod_postal=1000&ext_cod_postal=001
```