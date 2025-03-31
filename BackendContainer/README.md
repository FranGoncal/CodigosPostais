Exemplo de <oTeuRegistry> registocodigopostal.azurecr.io


- Construir Imagem:

    docker build -t codigo-postal:1.0 .

- Testar Imagem Localmente:

    docker run -p 8081:80 codigo-postal:1.0

- Disponibilizar no Azure Registry:

    docker login <oTeuRegistry>

    docker tag codigo-postal:1.0 <oTeuRegistry>/codigo-postal:1.0

    docker push <oTeuRegistry>/codigo-postal:1.0


-Para aceder:

    http://<IP>/?num_cod_postal=1000&ext_cod_postal=001
    ou
    http://<FQDN>/?num_cod_postal=1000&ext_cod_postal=001