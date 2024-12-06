<?php 

date_default_timezone_set('America/Sao_Paulo');

// Gera o nome do arquivo de backup baseado na data e hora atuais
$date = date("Y-m-d_H-i-s");
$nomeArquivoBackup = "BackupBanco_$date.bkp";

// Verifica se o arquivo de backup já existe
if (file_exists("arquivosBK/$nomeArquivoBackup")) {
     echo "Um arquivo assim já existe!";
} else {
    // Se o arquivo de backup não existir, procede para criar o backup
    $PASTA = "arquivosBK";
    // Cria a pasta se ela não existir
    if (!file_exists($PASTA)) {
        mkdir($PASTA, 0777, true);
    }
    
    // Caminho completo para o arquivo de backup com o nome baseado na data e hora
    $caminhoBackup = "$PASTA/$nomeArquivoBackup";

    // Comando para realizar o backup do banco de dados
    $command = '"C:/Program Files/MySQL/MySQL Workbench 8.0/mysqldump" --column-statistics=0 -u backup bancoDados > "' . $caminhoBackup . '"';
    
    // Executa o comando de backup
    $resultadoBackup = shell_exec($command);
    
    // Verifica se o backup foi realizado com sucesso ou realiza outras operações necessárias
    if ($resultadoBackup === null) {
        echo "Backup realizado com sucesso! Arquivo: $nomeArquivoBackup";
    } else {
        echo "Houve um erro ao realizar o backup.";
    }
}