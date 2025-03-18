<?php
class RestKezelo {

    private $httpVersion = "HTTP/1.1";

    public function setHttpFejlec($statusKod): void {
        $statusUzenet = $this->getHttpStatusUzenet($statusKod);
        header($this->httpVersion . " " . $statusKod . " " . $statusUzenet);
        header("Content-Type: application/json; charset=utf-8");
    }

    public function getHttpStatusUzenet($statusKod): string {
        $httpStatus = [
            200 => 'OK',
            400 => 'Bad Request',
            404 => 'Not Found'
        ];
        return $httpStatus[$statusKod] ?? 'Unknown Status';
    }
}
?>
