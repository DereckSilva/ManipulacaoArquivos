<?php

class Files
{
  protected $file;
  protected $openFile;
  protected $sizeFile;

  public function __construct(string $arquivo)
  {
    $this->file = __DIR__ . "/" . $arquivo;
  }

  //função apenas para ler um arquivo
  public function reading()
  {
    if (is_file($this->file)) {
      $this->openFile = fopen($this->file, 'r');
      $this->sizeFile = filesize($this->file);

      if ($this->sizeFile == 0) {
        throw new ExceptionFile("Size of file is 0", 0);
      } else {
        while ($row = fgets($this->openFile, $this->sizeFile)) {
          echo $row;
        }
      }

      fclose($this->openFile);
      echo "\nFile is closed";
    } else {
      throw new ExceptionFile("This is not a file", 1);
    }
  }

  //função para escrever em um arquivo
  public function writing($text)
  {
    if (is_file($this->file)) {
      $this->openFile = fopen($this->file, 'a+');
      fwrite($this->openFile, $text);

      fclose($this->openFile);
      echo "\nFile is closed";
    } else {
      throw new ExceptionFile("This is not a file", 1);
    }
  }
}

class ExceptionFile extends Exception
{
}

try {
  $test = new Files("index.txt");
  $test->reading();
} catch (ExceptionFile $e) {
  echo $e->getMessage();
}
