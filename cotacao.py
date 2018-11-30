#importa bibliotecas
import requests
import json
from datetime import date

#pega a data do sistema e formata no padrao da api M-D-YYYY
data_atual = date.today()
data_em_texto = '{}-{}-{}'.format(data_atual.month,data_atual.day,data_atual.year)

#monta a requisicao pra API do banco central
headers = {'user-agent' : 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'}
url = "https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarDia(dataCotacao=@dataCotacao)?@dataCotacao='"+data_em_texto+"'&$top=100&$format=json"
r = requests.get(url)
res = r.content
data = json.loads(res)

#filtra resultado e insere nas variaveis
for i in data['value']:
    venda = i['cotacaoVenda']
    compra =i['cotacaoCompra']
    data = i['dataHoraCotacao']

a = {'venda':venda,
	 'compra':compra,
	 'data': data}
#conecta no banco e insere os  valores na tabela
#mcursor = db.cursor()
#mcursor.execute(sql)
ver = json.dumps(a)
#monta resposta do script
print(ver)
