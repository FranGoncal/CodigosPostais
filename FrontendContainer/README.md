Exemplo de <oTeuRegistry> registocodigopostal.azurecr.io


NOTA: É necessário levantar primeiro o backend para descobrir o IP ou FQDN desse container, sendo necessária a substituição de "<FQDN>" na linha 57 do index.html


- Construir Imagem:

    docker build -t frontend-codigos:1.0 .

- Testar Imagem Localmente:

    docker run -p 8081:80 frontend-codigos:1.0

- Disponibilizar no Azure Registry:

    docker login <oTeuRegistry>

    docker tag frontend-codigos:1.0 <oTeuRegistry>/frontend-codigos:1.0

    docker push <oTeuRegistry>/frontend-codigos:1.0

-Para aceder:

    http://<IP>/
    ou
    http://<FQDN>/