Premissa

Desenvolver um serviço REST para tratar as regras de negócios descritas abaixo.

•	Linguagens: PHP (a partir da versão 5.6) 
•	Framework: Opcional
•	Informações devem ser persistidas em um banco relacional
•	Deverá ser criado o dockerfile para a montagem do ambiente
•	Os arquivos devem ser disponibilizados em um repositório GIT.

A utilização das seguintes tecnologias será considerada um diferencial:
•	O código PHP estar seguindo os padrões de desenvolvimento PSR-1, PSR-2 e PSR-5. 
•	Classes de testes para PHPUnit

Serviços a serem criados:
•	Inclusão de corredores para uma corrida
o	ID único
o	Nome 
o	CPF
o	Data de nascimento
•	Inclusão de provas
o	Id da prova
o	Tipo de prova (3, 5, 10, 21, 42km)
o	Data
•	Inclusão de corredores em provas
o	ID do corredor
o	ID da prova
•	Inclusão de resultados dos corredores
o	ID do corredor
o	ID da prova
o	Horário de início da prova
o	Horário de conclusão da prova
•	Listagem de classificação das provas por idade
o	ID da prova
o	Tipo de prova
o	ID do corredor
o	Idade
o	Nome do corredor
o	Posição
 
•	Listagem de classificação das provas gerais
o	ID da prova
o	Tipo de prova
o	ID do corredor
o	Idade
o	Nome do corredor
o	Posição
Regras de negócio
•	Todos os campos são obrigatórios.
•	Não é permitido cadastrar o mesmo corredor em duas provas diferentes na mesma data. Por exemplo, o corredor Barry Allen não pode estar cadastrado nas provas de 21km e 42km no dia 05/10/2019.
•	Não é permitida a inscrição de menores de idade.
•	As classificações são definidas pelo menor tempo de prova. 
•	A listagem de classificações por idade deve apresentar as posições dos candidatos dentro dos seguintes grupos em cada tipo de prova:
o	18 – 25 anos
o	25 – 35 anos
o	35 – 45 anos
o	45 – 55 anos
o	Acima de 55 anos
Por exemplo, as colocações de 18 -25 na prova de 3km apresentarão os 1º, 2º, 3º, ..., nesta faixa de idade, o mesmo para as outras faixas e tipos de provas.
•	A listagem de classificações gerais deve ser separada por tipos de provas.
