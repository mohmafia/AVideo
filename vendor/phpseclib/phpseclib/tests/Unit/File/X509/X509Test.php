<?php
/**
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2014 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

use phpseclib\File\ASN1;
use phpseclib\File\ASN1\Element;
use phpseclib\File\X509;
use phpseclib\Crypt\RSA;

class Unit_File_X509_X509Test extends PhpseclibTestCase
{
    public function testExtensionMapping()
    {
        $test = '-----BEGIN CERTIFICATE-----
MIIG1jCCBL6gAwIBAgITUAAAAA0qg8bE6DhrLAAAAAAADTANBgkqhkiG9w0BAQsF
ADAiMSAwHgYDVQQDExcuU2VjdXJlIEVudGVycHJpc2UgQ0EgMTAeFw0xNTAyMjMx
NTE1MDdaFw0xNjAyMjMxNTE1MDdaMD8xFjAUBgoJkiaJk/IsZAEZFgZzZWN1cmUx
DjAMBgNVBAMTBVVzZXJzMRUwEwYDVQQDEwxtZXRhY2xhc3NpbmcwggEiMA0GCSqG
SIb3DQEBAQUAA4IBDwAwggEKAoIBAQDMdG1CzR/gTalbLN9J+2cvMGeD7wsR7S78
HU5hdwE+kECROjRAcjFBOR57ezSDrkmhkTzo28tj0oAHjOh8N9vuXtASfZSCXugx
H+ImJ+E7PA4aXBp+0H2hohW9sXNNCFiVNmJLX66O4bxIeKtVRq/+eSNijV4OOEkC
zMyTHAUbOFP0t6KoJtM1syNoQ1+fKdfcjz5XtiEzSVcp2zf0MwNFSeZSgGQ0jh8A
Kd6YVKA8ZnrqOWZxKETT+bBNTjIT0ggjQfzcE4zW2RzrN7zWabUowoU92+DAp4s3
sAEywX9ISSge62DEzTnZZSf9bpoScAfT8raRFA3BkoJ/s4c4CgfPAgMBAAGjggLm
MIIC4jAdBgNVHQ4EFgQULlIyJL9+ZwAI/SkVdsJMxFOVp+EwHwYDVR0jBBgwFoAU
5nEIMEUT5mMd1WepmviwgK7dIzwwggEKBgNVHR8EggEBMIH+MIH7oIH4oIH1hoG5
bGRhcDovLy9DTj0uU2VjdXJlJTIwRW50ZXJwcmlzZSUyMENBJTIwMSxDTj1hdXRo
LENOPUNEUCxDTj1QdWJsaWMlMjBLZXklMjBTZXJ2aWNlcyxDTj1TZXJ2aWNlcyxD
Tj1Db25maWd1cmF0aW9uLERDPXNlY3VyZT9jZXJ0aWZpY2F0ZVJldm9jYXRpb25M
aXN0P2Jhc2U/b2JqZWN0Q2xhc3M9Y1JMRGlzdHJpYnV0aW9uUG9pbnSGN2h0dHA6
Ly9jcmwuc2VjdXJlb2JzY3VyZS5jb20vP2FjdGlvbj1jcmwmY2E9ZW50ZXJwcmlz
ZTEwgccGCCsGAQUFBwEBBIG6MIG3MIG0BggrBgEFBQcwAoaBp2xkYXA6Ly8vQ049
LlNlY3VyZSUyMEVudGVycHJpc2UlMjBDQSUyMDEsQ049QUlBLENOPVB1YmxpYyUy
MEtleSUyMFNlcnZpY2VzLENOPVNlcnZpY2VzLENOPUNvbmZpZ3VyYXRpb24sREM9
c2VjdXJlP2NBQ2VydGlmaWNhdGU/YmFzZT9vYmplY3RDbGFzcz1jZXJ0aWZpY2F0
aW9uQXV0aG9yaXR5MBcGCSsGAQQBgjcUAgQKHggAVQBzAGUAcjAOBgNVHQ8BAf8E
BAMCBaAwKQYDVR0lBCIwIAYKKwYBBAGCNwoDBAYIKwYBBQUHAwQGCCsGAQUFBwMC
MC4GA1UdEQQnMCWgIwYKKwYBBAGCNxQCA6AVDBNtZXRhY2xhc3NpbmdAc2VjdXJl
MEQGCSqGSIb3DQEJDwQ3MDUwDgYIKoZIhvcNAwICAgCAMA4GCCqGSIb3DQMEAgIA
gDAHBgUrDgMCBzAKBggqhkiG9w0DBzANBgkqhkiG9w0BAQsFAAOCAgEAKNmjYh+h
cObJEM0CWgz50jOYKZ4M5iIxoAWgrYY9Pv+0O9aPjvPLzjd5bY322L8lxh5wy5my
DKmip+irzjdVdxzQfoyy+ceODmCbX9L6MfEDn0RBzdwjLe1/eOxE1na0sZztrVCc
yt5nI91NNGZJUcVqVQsIA/25FWlkvo/FTfuqTuXdQiEVM5MCKJI915anmTdugy+G
0CmBJALIxtyz5P7sZhaHZFNdpKnx82QsauErqjP9H0RXc6VXX5qt+tEDvYfSlFcc
0lv3aQnV/eIdfm7APJkQ3lmNWWQwdkVf7adXJ7KAAPHSt1yvSbVxThJR/jmIkyeQ
XW/TOP5m7JI/GrmvdlzI1AgwJ+zO8fOmCDuif99pDb1CvkzQ65RZ8p5J1ZV6hzlb
VvOhn4LDnT1jnTcEqigmx1gxM/5ifvMorXn/ItMjKPlb72vHpeF7OeKE8GHsvZAm
osHcKyJXbTIcXchmpZX1efbmCMJBqHgJ/qBTBMl9BX0+YqbTZyabRJSs9ezbTRn0
oRYl21Q8EnvS71CemxEUkSsKJmfJKkQNCsOjc8AbX/V/X9R7LJkH3UEx6K2zQQKK
k6m17mi63YW/+iPCGOWZ2qXmY5HPEyyF2L4L4IDryFJ+8xLyw3pH9/yp5aHZDtp6
833K6qyjgHJT+fUzSEYpiwF5rSBJIGClOCY=
-----END CERTIFICATE-----';

        $x509 = new X509();

        $cert = $x509->loadX509($test);

        $this->assertIsArray($cert['tbsCertificate']['extensions'][3]['extnValue']);
    }

    public function testLoadUnsupportedExtension()
    {
        $test = '-----BEGIN CERTIFICATE-----
MIIG1jCCBL6gAwIBAgITUAAAAA0qg8bE6DhrLAAAAAAADTANBgkqhkiG9w0BAQsF
ADAiMSAwHgYDVQQDExcuU2VjdXJlIEVudGVycHJpc2UgQ0EgMTAeFw0xNTAyMjMx
NTE1MDdaFw0xNjAyMjMxNTE1MDdaMD8xFjAUBgoJkiaJk/IsZAEZFgZzZWN1cmUx
DjAMBgNVBAMTBVVzZXJzMRUwEwYDVQQDEwxtZXRhY2xhc3NpbmcwggEiMA0GCSqG
SIb3DQEBAQUAA4IBDwAwggEKAoIBAQDMdG1CzR/gTalbLN9J+2cvMGeD7wsR7S78
HU5hdwE+kECROjRAcjFBOR57ezSDrkmhkTzo28tj0oAHjOh8N9vuXtASfZSCXugx
H+ImJ+E7PA4aXBp+0H2hohW9sXNNCFiVNmJLX66O4bxIeKtVRq/+eSNijV4OOEkC
zMyTHAUbOFP0t6KoJtM1syNoQ1+fKdfcjz5XtiEzSVcp2zf0MwNFSeZSgGQ0jh8A
Kd6YVKA8ZnrqOWZxKETT+bBNTjIT0ggjQfzcE4zW2RzrN7zWabUowoU92+DAp4s3
sAEywX9ISSge62DEzTnZZSf9bpoScAfT8raRFA3BkoJ/s4c4CgfPAgMBAAGjggLm
MIIC4jAdBgNVHQ4EFgQULlIyJL9+ZwAI/SkVdsJMxFOVp+EwHwYDVR0jBBgwFoAU
5nEIMEUT5mMd1WepmviwgK7dIzwwggEKBgNVHR8EggEBMIH+MIH7oIH4oIH1hoG5
bGRhcDovLy9DTj0uU2VjdXJlJTIwRW50ZXJwcmlzZSUyMENBJTIwMSxDTj1hdXRo
LENOPUNEUCxDTj1QdWJsaWMlMjBLZXklMjBTZXJ2aWNlcyxDTj1TZXJ2aWNlcyxD
Tj1Db25maWd1cmF0aW9uLERDPXNlY3VyZT9jZXJ0aWZpY2F0ZVJldm9jYXRpb25M
aXN0P2Jhc2U/b2JqZWN0Q2xhc3M9Y1JMRGlzdHJpYnV0aW9uUG9pbnSGN2h0dHA6
Ly9jcmwuc2VjdXJlb2JzY3VyZS5jb20vP2FjdGlvbj1jcmwmY2E9ZW50ZXJwcmlz
ZTEwgccGCCsGAQUFBwEBBIG6MIG3MIG0BggrBgEFBQcwAoaBp2xkYXA6Ly8vQ049
LlNlY3VyZSUyMEVudGVycHJpc2UlMjBDQSUyMDEsQ049QUlBLENOPVB1YmxpYyUy
MEtleSUyMFNlcnZpY2VzLENOPVNlcnZpY2VzLENOPUNvbmZpZ3VyYXRpb24sREM9
c2VjdXJlP2NBQ2VydGlmaWNhdGU/YmFzZT9vYmplY3RDbGFzcz1jZXJ0aWZpY2F0
aW9uQXV0aG9yaXR5MBcGCSsGAQQBgjcUAgQKHggAVQBzAGUAcjAOBgNVHQ8BAf8E
BAMCBaAwKQYDVR0lBCIwIAYKKwYBBAGCNwoDBAYIKwYBBQUHAwQGCCsGAQUFBwMC
MC4GA1UdEQQnMCWgIwYKKwYBBAGCNxQCA6AVDBNtZXRhY2xhc3NpbmdAc2VjdXJl
MEQGCSqGSIb3DQEJDwQ3MDUwDgYIKoZIhvcNAwICAgCAMA4GCCqGSIb3DQMEAgIA
gDAHBgUrDgMCBzAKBggqhkiG9w0DBzANBgkqhkiG9w0BAQsFAAOCAgEAKNmjYh+h
cObJEM0CWgz50jOYKZ4M5iIxoAWgrYY9Pv+0O9aPjvPLzjd5bY322L8lxh5wy5my
DKmip+irzjdVdxzQfoyy+ceODmCbX9L6MfEDn0RBzdwjLe1/eOxE1na0sZztrVCc
yt5nI91NNGZJUcVqVQsIA/25FWlkvo/FTfuqTuXdQiEVM5MCKJI915anmTdugy+G
0CmBJALIxtyz5P7sZhaHZFNdpKnx82QsauErqjP9H0RXc6VXX5qt+tEDvYfSlFcc
0lv3aQnV/eIdfm7APJkQ3lmNWWQwdkVf7adXJ7KAAPHSt1yvSbVxThJR/jmIkyeQ
XW/TOP5m7JI/GrmvdlzI1AgwJ+zO8fOmCDuif99pDb1CvkzQ65RZ8p5J1ZV6hzlb
VvOhn4LDnT1jnTcEqigmx1gxM/5ifvMorXn/ItMjKPlb72vHpeF7OeKE8GHsvZAm
osHcKyJXbTIcXchmpZX1efbmCMJBqHgJ/qBTBMl9BX0+YqbTZyabRJSs9ezbTRn0
oRYl21Q8EnvS71CemxEUkSsKJmfJKkQNCsOjc8AbX/V/X9R7LJkH3UEx6K2zQQKK
k6m17mi63YW/+iPCGOWZ2qXmY5HPEyyF2L4L4IDryFJ+8xLyw3pH9/yp5aHZDtp6
833K6qyjgHJT+fUzSEYpiwF5rSBJIGClOCY=
-----END CERTIFICATE-----';

        $x509 = new X509();

        $cert = $x509->loadX509($test);

        $this->assertEquals('MDUwDgYIKoZIhvcNAwICAgCAMA4GCCqGSIb3DQMEAgIAgDAHBgUrDgMCBzAKBggqhkiG9w0DBw==', $cert['tbsCertificate']['extensions'][8]['extnValue']);
    }

    public function testSaveUnsupportedExtension()
    {
        $x509 = new X509();
        $cert = $x509->loadX509('-----BEGIN CERTIFICATE-----
MIIDITCCAoqgAwIBAgIQT52W2WawmStUwpV8tBV9TTANBgkqhkiG9w0BAQUFADBM
MQswCQYDVQQGEwJaQTElMCMGA1UEChMcVGhhd3RlIENvbnN1bHRpbmcgKFB0eSkg
THRkLjEWMBQGA1UEAxMNVGhhd3RlIFNHQyBDQTAeFw0xMTEwMjYwMDAwMDBaFw0x
MzA5MzAyMzU5NTlaMGgxCzAJBgNVBAYTAlVTMRMwEQYDVQQIEwpDYWxpZm9ybmlh
MRYwFAYDVQQHFA1Nb3VudGFpbiBWaWV3MRMwEQYDVQQKFApHb29nbGUgSW5jMRcw
FQYDVQQDFA53d3cuZ29vZ2xlLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkC
gYEA3rcmQ6aZhc04pxUJuc8PycNVjIjujI0oJyRLKl6g2Bb6YRhLz21ggNM1QDJy
wI8S2OVOj7my9tkVXlqGMaO6hqpryNlxjMzNJxMenUJdOPanrO/6YvMYgdQkRn8B
d3zGKokUmbuYOR2oGfs5AER9G5RqeC1prcB6LPrQ2iASmNMCAwEAAaOB5zCB5DAM
BgNVHRMBAf8EAjAAMDYGA1UdHwQvMC0wK6ApoCeGJWh0dHA6Ly9jcmwudGhhd3Rl
LmNvbS9UaGF3dGVTR0NDQS5jcmwwKAYDVR0lBCEwHwYIKwYBBQUHAwEGCCsGAQUF
BwMCBglghkgBhvhCBAEwcgYIKwYBBQUHAQEEZjBkMCIGCCsGAQUFBzABhhZodHRw
Oi8vb2NzcC50aGF3dGUuY29tMD4GCCsGAQUFBzAChjJodHRwOi8vd3d3LnRoYXd0
ZS5jb20vcmVwb3NpdG9yeS9UaGF3dGVfU0dDX0NBLmNydDANBgkqhkiG9w0BAQUF
AAOBgQAhrNWuyjSJWsKrUtKyNGadeqvu5nzVfsJcKLt0AMkQH0IT/GmKHiSgAgDp
ulvKGQSy068Bsn5fFNum21K5mvMSf3yinDtvmX3qUA12IxL/92ZzKbeVCq3Yi7Le
IOkKcGQRCMha8X2e7GmlpdWC1ycenlbN0nbVeSv3JUMcafC4+Q==
-----END CERTIFICATE-----');

        $asn1 = new ASN1();

        $value = $this->_encodeOID('1.2.3.4');
        $ext = chr(ASN1::TYPE_OBJECT_IDENTIFIER) . $asn1->_encodeLength(strlen($value)) . $value;
        $value = 'zzzzzzzzz';
        $ext.= chr(ASN1::TYPE_OCTET_STRING) . $asn1->_encodeLength(strlen($value)) . $value;
        $ext = chr(ASN1::TYPE_SEQUENCE | 0x20) . $asn1->_encodeLength(strlen($ext)) . $ext;

        $cert['tbsCertificate']['extensions'][4] = new Element($ext);

        $result = $x509->loadX509($x509->saveX509($cert));

        $this->assertCount(5, $result['tbsCertificate']['extensions']);
    }

    /**
     * @group github705
     */
    public function testSaveNullRSAParam()
    {
        $privKey = new RSA();
        $privKey->loadKey('-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDMswfEpAgnUDWA74zZw5XcPsWh1ly1Vk99tsqwoFDkLF7jvXy1
dDLHYfuquvfxCgcp8k/4fQhx4ubR8bbGgEq9B05YRnViK0R0iBB5Ui4IaxWYYhKE
8xqAEH2fL+/7nsqqNFKkEN9KeFwc7WbMY49U2adlMrpBdRjk1DqIEW3QTwIDAQAB
AoGBAJ+83cT/1DUJjJcPWLTeweVbPtJp+3Ku5d1OdaGbmURVs764scbP5Ihe2AuF
V9LLZoe/RdS9jYeB72nJ3D3PA4JVYYgqMOnJ8nlUMNQ+p0yGl5TqQk6EKLI8MbX5
kQEazNqFXsiWVQXubAd5wjtb6g0n0KD3zoT/pWLES7dtUFexAkEA89h5+vbIIl2P
H/NnkPie2NWYDZ1YiMGHFYxPDwsd9KCZMSbrLwAhPg9bPgqIeVNfpwxrzeksS6D9
P98tJt335QJBANbnCe+LhDSrkpHMy9aOG2IdbLGG63MSRUCPz8v2gKPq3kYXDxq6
Y1iqF8N5g0k5iirHD2qlWV5Q+nuGvFTafCMCQQC1wQiC0IkyXEw/Q31RqI82Dlcs
5rhEDwQyQof3LZEhcsdcxKaOPOmKSYX4A3/f9w4YBIEiVQfoQ1Ig1qfgDZklAkAT
TQDJcOBY0qgBTEFqbazr7PScJR/0X8m0eLYS/XqkPi3kYaHLpr3RcsVbmwg9hVtx
aBtsWpliLSex/HHhtRW9AkBGcq67zKmEpJ9kXcYLEjJii3flFS+Ct/rNm+Hhm1l7
4vca9v/F2hGVJuHIMJ8mguwYlNYzh2NqoIDJTtgOkBmt
-----END RSA PRIVATE KEY-----');

        $pubKey = new RSA();
        $pubKey->loadKey($privKey->getPublicKey());
        $pubKey->setPublicKey();

        $subject = new X509();
        $subject->setDNProp('id-at-organizationName', 'phpseclib demo cert');
        $subject->setPublicKey($pubKey);

        $issuer = new X509();
        $issuer->setPrivateKey($privKey);
        $issuer->setDN($subject->getDN());

        $x509 = new X509();

        $result = $x509->sign($issuer, $subject);
        $cert = $x509->saveX509($result);
        $cert = $x509->loadX509($cert);

        $this->assertArrayHasKey('parameters', $cert['tbsCertificate']['subjectPublicKeyInfo']['algorithm']);
        $this->assertArrayHasKey('parameters', $cert['signatureAlgorithm']);
        $this->assertArrayHasKey('parameters', $cert['tbsCertificate']['signature']);
    }

    private function _encodeOID($oid)
    {
        if ($oid === false) {
            user_error('Invalid OID');
            return false;
        }
        $value = '';
        $parts = explode('.', $oid);
        $value = chr(40 * $parts[0] + $parts[1]);
        for ($i = 2; $i < count($parts); $i++) {
            $temp = '';
            if (!$parts[$i]) {
                $temp = "\0";
            } else {
                while ($parts[$i]) {
                    $temp = chr(0x80 | ($parts[$i] & 0x7F)) . $temp;
                    $parts[$i] >>= 7;
                }
                $temp[strlen($temp) - 1] = $temp[strlen($temp) - 1] & chr(0x7F);
            }
            $value.= $temp;
        }
        return $value;
    }

    public function testGetOID()
    {
        $x509 = new X509();
        $this->assertEquals($x509->getOID('2.16.840.1.101.3.4.2.1'), '2.16.840.1.101.3.4.2.1');
        $this->assertEquals($x509->getOID('id-sha256'), '2.16.840.1.101.3.4.2.1');
        $this->assertEquals($x509->getOID('zzz'), 'zzz');
    }

    public function testIPAddressSubjectAltNamesDecoding()
    {
        $test = '-----BEGIN CERTIFICATE-----
MIIEcTCCAlmgAwIBAgIBDjANBgkqhkiG9w0BAQsFADAfMR0wGwYDVQQDDBQuU2Vj
dXJlIElzc3VpbmcgQ0EgMTAeFw0xNjAxMjUyMzIwMjZaFw0yMTAxMjYyMzIwMjZa
MBoxGDAWBgNVBAMMDzIwNC4xNTIuMjAwLjI1MDCCASIwDQYJKoZIhvcNAQEBBQAD
ggEPADCCAQoCggEBAM9lMPiYQ26L5qXR1rlUXM0Z3DeRhDsJ/9NadLFJnvxKCV5L
M9rlrThpK6V5VbgPgEwKVLXGtJoGSEUkLd4roJ25ZTH08GcYszWyp8nLPQRovYnN
+aeE1aefnHcpt524f0Es9NFXh0uwRWV3ZCWSwN+mo9Qo6507KZq+q34if7/q9+De
O5RJumVQWc9OCjCt6pQBnBua9oCAca+SIHftOdgWXqVw+Xvl6/dLeF70jJD43P00
+bdAnGDgBdgO+p+K+XrOCaCWMcCsRX5xiK4hUG54UM5ayBST+McyfjsKxpO2djPg
FlSL0RLg+Nj8WehANUUuaNU874Pp3FV5GTI0ZbUCAwEAAaOBvDCBuTAMBgNVHRMB
Af8EAjAAMAsGA1UdDwQEAwIF4DATBgNVHSUEDDAKBggrBgEFBQcDATAhBgNVHREE
GjAYhwTMmMj6hxAgAQRw8wkACQAAAAAAAAADMEMGA1UdHwQ8MDowOKA2oDSGMmh0
dHA6Ly9jcmwuc2VjdXJlb2JzY3VyZS5jb20vP2FjdGlvbj1jcmwmY2E9aXNzdWUx
MB8GA1UdIwQYMBaAFOJWVCX4poZSBzemgihf9dAhFNHJMA0GCSqGSIb3DQEBCwUA
A4ICAQAce9whx4InRtzk1to6oeRxTCbeNDjNFuTkotphSws4hDoaz3nyFLSYyMT4
aKFnNP9AmMS5nEXphtP4HP9wAluTcAFMuip0rDJjiRA/khIE27KurO6cg1faFWHl
6lh6xnEf9UFZZzTLsXt2miBiMb8olgPrBuVFWjPZ/ConesJRZRFqMd5mfntXC+2V
zRcXdtwp9h/Am/WuvjsG/gBAPdeRNKffCokIcgfvffd2oklSDD0T9baG2MTgaxnX
oG6e5saWjoN8bLWuCJpvjA7aErXQwXUyXx1nrTWQ1TCR2N+M62X7e07jZLKSAECP
v6SqZ9/LDmCacVQbfg4wDC/gbpjDSKaD5fkusH6leXleWQ7X8Z03LsKvVq43a71z
jO61kkiFAh3CegWsY+TSYjZxDq58xGMiE7y/fK+SHQXDLyY7HU4eky2l3DSy8bXQ
p64vTJ/OmAcXVNUASfBCNw0kpxuFjlxers/+6zheowB1RIKo0xvSRC4cEDRl/jFA
b7WUT/MIe6B1r0v1gxHnFG2bFI/MhTT9V+tICOLo7+69z4jf/OFkzjYvqq2QWPgc
sE3f2TNnmKFRJx67bEMoaaWLIR94Yuq/TWB6dTiWwk9meZkGG3OjQg/YbO6vl/Am
NDEuGt30Vl2de7G1glnhaceB6Q9KfH7p2gAwNP9JMTtx3PtEcA==
-----END CERTIFICATE-----';

        $x509 = new X509();
        $cert = $x509->loadX509($test);
        $this->assertEquals($cert['tbsCertificate']['extensions'][3]['extnValue'][0]['iPAddress'], '204.152.200.250');
        $this->assertEquals($cert['tbsCertificate']['extensions'][3]['extnValue'][1]['iPAddress'], '2001:470:f309:9::3');
    }

    public function testPostalAddress()
    {
        $x509 = new X509();
        $decoded = $x509->loadX509('-----BEGIN CERTIFICATE-----
MIIFzzCCBLegAwIBAgIDAfdlMA0GCSqGSIb3DQEBBQUAMHMxCzAJBgNVBAYTAlBM
MSgwJgYDVQQKDB9LcmFqb3dhIEl6YmEgUm96bGljemVuaW93YSBTLkEuMSQwIgYD
VQQDDBtDT1BFIFNaQUZJUiAtIEt3YWxpZmlrb3dhbnkxFDASBgNVBAUTC05yIHdw
aXN1OiA2MB4XDTExMTEwOTA2MDAwMFoXDTEzMTEwOTA2MDAwMFowgdkxCzAJBgNV
BAYTAlBMMRwwGgYDVQQKDBNVcnrEhWQgTWlhc3RhIEdkeW5pMRswGQYDVQQFExJQ
RVNFTDogNjEwNjA2MDMxMTgxGTAXBgNVBAMMEEplcnp5IFByemV3b3Jza2kxTzBN
BgNVBBAwRgwiQWwuIE1hcnN6YcWCa2EgUGnFgnN1ZHNraWVnbyA1Mi81NAwNODEt
MzgyIEdkeW5pYQwGUG9sc2thDAlwb21vcnNraWUxDjAMBgNVBCoMBUplcnp5MRMw
EQYDVQQEDApQcnpld29yc2tpMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCM
m5vjGqHPthJCMqKpqssSISRos0PYDTcEQzyyurfX67EJWKtZj6HNwuDMEGJ02iBN
ZfjUl7r8dIi28bSKhNlsfycXZKYRcIjp0+r5RqtR2auo9GQ6veKb61DEAGIqaR+u
LLcJVTHCu0w9oXLGbRlGth5eNoj03CxXVAH2IfhbNwIDAQABo4IChzCCAoMwDAYD
VR0TAQH/BAIwADCCAUgGA1UdIAEB/wSCATwwggE4MIIBNAYJKoRoAYb3IwEBMIIB
JTCB3QYIKwYBBQUHAgIwgdAMgc1EZWtsYXJhY2phIHRhIGplc3Qgb8Wbd2lhZGN6
ZW5pZW0gd3lkYXdjeSwgxbxlIHRlbiBjZXJ0eWZpa2F0IHpvc3RhxYIgd3lkYW55
IGpha28gY2VydHlmaWthdCBrd2FsaWZpa293YW55IHpnb2RuaWUgeiB3eW1hZ2Fu
aWFtaSB1c3Rhd3kgbyBwb2RwaXNpZSBlbGVrdHJvbmljem55bSBvcmF6IHRvd2Fy
enlzesSFY3ltaSBqZWogcm96cG9yesSFZHplbmlhbWkuMEMGCCsGAQUFBwIBFjdo
dHRwOi8vd3d3Lmtpci5jb20ucGwvY2VydHlmaWthY2phX2tsdWN6eS9wb2xpdHlr
YS5odG1sMAkGA1UdCQQCMAAwIQYDVR0RBBowGIEWai5wcnpld29yc2tpQGdkeW5p
YS5wbDAOBgNVHQ8BAf8EBAMCBkAwgZ4GA1UdIwSBljCBk4AU3TGldJXipN4oGS3Z
YmnBDMFs8gKhd6R1MHMxCzAJBgNVBAYTAlBMMSgwJgYDVQQKDB9LcmFqb3dhIEl6
YmEgUm96bGljemVuaW93YSBTLkEuMSQwIgYDVQQDDBtDT1BFIFNaQUZJUiAtIEt3
YWxpZmlrb3dhbnkxFDASBgNVBAUTC05yIHdwaXN1OiA2ggJb9jBIBgNVHR8EQTA/
MD2gO6A5hjdodHRwOi8vd3d3Lmtpci5jb20ucGwvY2VydHlmaWthY2phX2tsdWN6
eS9DUkxfT1pLMzIuY3JsMA0GCSqGSIb3DQEBBQUAA4IBAQBYPIqnAreyeql7/opJ
jcar/qWZy9ruhB2q0lZFsJOhwgMnbQXzp/4vv93YJqcHGAXdHP6EO8FQX47mjo2Z
KQmi+cIHJHLONdX/3Im+M17V0iNAh7Z1lOSfTRT+iiwe/F8phcEaD5q2RmvYusR7
zXZq/cLL0If0hXoPZ/EHQxjN8pxzxiUx6bJAgturnIMEfRNesxwghdr1dkUjOhGL
f3kHVzgM6j3VAM7oFmMUb5y5s96Bzl10DodWitjOEH0vvnIcsppSxH1C1dCAi0o9
f/1y2XuLNhBNHMAyTqpYPX8Yvav1c+Z50OMaSXHAnTa20zv8UtiHbaAhwlifCelU
Mj93S
-----END CERTIFICATE-----');
        $x509->loadX509($x509->saveX509($decoded));
        $expected = array(
            array(
                array('utf8String' => "Al. Marsza\xC5\x82ka Pi\xC5\x82sudskiego 52/54"),
                array('utf8String' => '81-382 Gdynia'),
                array('utf8String' => 'Polska'),
                array('utf8String' => 'pomorskie')
            )
        );
        $this->assertEquals($x509->getDNProp('id-at-postalAddress'), $expected);

        $expected = "C=PL, O=Urz\xC4\x85d Miasta Gdyni/serialNumber=PESEL: 61060603118, CN=Jerzy Przeworski/postalAddress=" . '0F\X0C"AL. MARSZA\XC5\X82KA PI\XC5\X82SUDSKIEGO 52/54\X0C\X0D81-382 GDYNIA\X0C\X06POLSKA\X0C\X09POMORSKIE/givenName=Jerzy, SN=Przeworski';
        $this->assertEquals($x509->getDN(X509::DN_STRING), $expected);
    }

    public function testStrictComparison()
    {
        $x509 = new X509();
        $x509->loadCA('-----BEGIN CERTIFICATE-----
MIIEbDCCA1SgAwIBAgIUJguKOMpJm/yRMDlMOW04NV0YPXowDQYJKoZIhvcNAQEF
BQAwYTELMAkGA1UEBhMCUEwxNzA1BgNVBAoTLkNaaUMgQ2VudHJhc3QgU0EgdyBp
bWllbml1IE1pbmlzdHJhIEdvc3BvZGFya2kxGTAXBgNVBAMTEENaaUMgQ2VudHJh
c3QgU0EwHhcNMDkwNDI5MTE1MzIxWhcNMTMxMjEzMjM1OTU5WjBzMQswCQYDVQQG
EwJQTDEoMCYGA1UEChMfS3Jham93YSBJemJhIFJvemxpY3plbmlvd2EgUy5BLjEk
MCIGA1UEAxMbQ09QRSBTWkFGSVIgLSBLd2FsaWZpa293YW55MRQwEgYDVQQFEwtO
ciB3cGlzdTogNjCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAIjNy3EL
oK0uKTqAJokiP8VIxER/0OfwhY4DBhJGW38W6Pfema8iUs4net0NgoIeDpMQ8IHj
FDSKkSaRkyL5f7PgvqBwzKe0HD1Duf9G/Lr2lu/J4QUMF3rqKaMRipXKkkEoKrub
Qe41/mPiPXeClNswNQUEyInqWpfWNncU8AIs2GKIFTfSNqK4PgWOY1kG9MYfoNVr
74dhejv7yHexEw9eAIcM1fIkEEq0vWIOjRtBXBAuWtUyD8iSeBs4nIN+614pHIjv
ncHxG7xTDbmOAVZFgGZ8Hk5CUseAtTpazQNdU66XRUuCj4km01L4wsfZ1X8tfYQA
6msMRYj+F7hLtoECAwEAAaOCAQgwggEEMA8GA1UdEwEB/wQFMAMBAf8wgY4GA1Ud
IwSBhjCBg4AU2a7r85Cp1iJNW0Ca1LR6VG3996ShZaRjMGExCzAJBgNVBAYTAlBM
MTcwNQYDVQQKEy5DWmlDIENlbnRyYXN0IFNBIHcgaW1pZW5pdSBNaW5pc3RyYSBH
b3Nwb2RhcmtpMRkwFwYDVQQDExBDWmlDIENlbnRyYXN0IFNBggQ9/0sQMDEGA1Ud
IAEB/wQnMCUwIwYEVR0gADAbMBkGCCsGAQUFBwIBFg13d3cubmNjZXJ0LnBsMA4G
A1UdDwEB/wQEAwIBBjAdBgNVHQ4EFgQU3TGldJXipN4oGS3ZYmnBDMFs8gIwDQYJ
KoZIhvcNAQEFBQADggEBAJrkn3XycfimT5C6D+lYvQNB4/X44KZRhxhnplMOdr/V
3O13oJA/G2SkVaRZS1Rqy01vC9H3YSFfYnjFXJTOXldzodwszHEcGLHF/3JazHI9
BTpP1F4oFyd0Un/wkp1usGU4e1riU5RAlSp8YcMX3q+nOqyCh0JsxnP7LjauHkE3
KZ1RuBDZYbsYOwkAKjHax8srKugdWtq4sMNcqpxGFUah/4uLQn6hD4jeRpP4VGDv
HZDmxaIoJdmCxfn9XeIS5PcZR+mHHkUOIhYLnfdUp/T3Yxxo+XrrTckC6AjtsL5/
OA0vBLngVqqeuzVf0tUhcrCwPKQo5rKoakbApeXrows=
-----END CERTIFICATE-----');

        $x509->loadX509('-----BEGIN CERTIFICATE-----
MIIFzzCCBLegAwIBAgIDAfdlMA0GCSqGSIb3DQEBBQUAMHMxCzAJBgNVBAYTAlBM
MSgwJgYDVQQKDB9LcmFqb3dhIEl6YmEgUm96bGljemVuaW93YSBTLkEuMSQwIgYD
VQQDDBtDT1BFIFNaQUZJUiAtIEt3YWxpZmlrb3dhbnkxFDASBgNVBAUTC05yIHdw
aXN1OiA2MB4XDTExMTEwOTA2MDAwMFoXDTEzMTEwOTA2MDAwMFowgdkxCzAJBgNV
BAYTAlBMMRwwGgYDVQQKDBNVcnrEhWQgTWlhc3RhIEdkeW5pMRswGQYDVQQFExJQ
RVNFTDogNjEwNjA2MDMxMTgxGTAXBgNVBAMMEEplcnp5IFByemV3b3Jza2kxTzBN
BgNVBBAwRgwiQWwuIE1hcnN6YcWCa2EgUGnFgnN1ZHNraWVnbyA1Mi81NAwNODEt
MzgyIEdkeW5pYQwGUG9sc2thDAlwb21vcnNraWUxDjAMBgNVBCoMBUplcnp5MRMw
EQYDVQQEDApQcnpld29yc2tpMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCM
m5vjGqHPthJCMqKpqssSISRos0PYDTcEQzyyurfX67EJWKtZj6HNwuDMEGJ02iBN
ZfjUl7r8dIi28bSKhNlsfycXZKYRcIjp0+r5RqtR2auo9GQ6veKb61DEAGIqaR+u
LLcJVTHCu0w9oXLGbRlGth5eNoj03CxXVAH2IfhbNwIDAQABo4IChzCCAoMwDAYD
VR0TAQH/BAIwADCCAUgGA1UdIAEB/wSCATwwggE4MIIBNAYJKoRoAYb3IwEBMIIB
JTCB3QYIKwYBBQUHAgIwgdAMgc1EZWtsYXJhY2phIHRhIGplc3Qgb8Wbd2lhZGN6
ZW5pZW0gd3lkYXdjeSwgxbxlIHRlbiBjZXJ0eWZpa2F0IHpvc3RhxYIgd3lkYW55
IGpha28gY2VydHlmaWthdCBrd2FsaWZpa293YW55IHpnb2RuaWUgeiB3eW1hZ2Fu
aWFtaSB1c3Rhd3kgbyBwb2RwaXNpZSBlbGVrdHJvbmljem55bSBvcmF6IHRvd2Fy
enlzesSFY3ltaSBqZWogcm96cG9yesSFZHplbmlhbWkuMEMGCCsGAQUFBwIBFjdo
dHRwOi8vd3d3Lmtpci5jb20ucGwvY2VydHlmaWthY2phX2tsdWN6eS9wb2xpdHlr
YS5odG1sMAkGA1UdCQQCMAAwIQYDVR0RBBowGIEWai5wcnpld29yc2tpQGdkeW5p
YS5wbDAOBgNVHQ8BAf8EBAMCBkAwgZ4GA1UdIwSBljCBk4AU3TGldJXipN4oGS3Z
YmnBDMFs8gKhd6R1MHMxCzAJBgNVBAYTAlBMMSgwJgYDVQQKDB9LcmFqb3dhIEl6
YmEgUm96bGljemVuaW93YSBTLkEuMSQwIgYDVQQDDBtDT1BFIFNaQUZJUiAtIEt3
YWxpZmlrb3dhbnkxFDASBgNVBAUTC05yIHdwaXN1OiA2ggJb9jBIBgNVHR8EQTA/
MD2gO6A5hjdodHRwOi8vd3d3Lmtpci5jb20ucGwvY2VydHlmaWthY2phX2tsdWN6
eS9DUkxfT1pLMzIuY3JsMA0GCSqGSIb3DQEBBQUAA4IBAQBYPIqnAreyeql7/opJ
jcar/qWZy9ruhB2q0lZFsJOhwgMnbQXzp/4vv93YJqcHGAXdHP6EO8FQX47mjo2Z
KQmi+cIHJHLONdX/3Im+M17V0iNAh7Z1lOSfTRT+iiwe/F8phcEaD5q2RmvYusR7
zXZq/cLL0If0hXoPZ/EHQxjN8pxzxiUx6bJAgturnIMEfRNesxwghdr1dkUjOhGL
f3kHVzgM6j3VAM7oFmMUb5y5s96Bzl10DodWitjOEH0vvnIcsppSxH1C1dCAi0o9
f/1y2XuLNhBNHMAyTqpYPX8Yvav1c+Z50OMaSXHAnTa20zv8UtiHbaAhwlifCelU
Mj93S
-----END CERTIFICATE-----');
        $this->assertFalse($x509->validateSignature());
    }

    // fixed by #1104
    public function testMultipleDomainNames()
    {
        $keyGenerator = new RSA();
        $keys = $keyGenerator->createKey(512);

        $privateKey = new RSA();
        $privateKey->loadKey($keys['privatekey']);

        $publicKey = new RSA();
        $publicKey->loadKey($keys['publickey']);
        $publicKey->setPublicKey();

        $subject = new X509();
        $subject->setDomain('example.com', 'example.net');

        $subject->setPublicKey($publicKey);

        $issuer = new X509();
        $issuer->setPrivateKey($privateKey);
        $issuer->setDN($subject->getDN());

        $x509 = new X509();
        $x509->sign($issuer, $subject);
    }

    public function testUtcTimeWithoutSeconds()
    {
        $test = '-----BEGIN CERTIFICATE-----
MIIGFDCCBPygAwIBAgIDKCHVMA0GCSqGSIb3DQEBBQUAMIHcMQswCQYDVQQGEwJVUzEQMA4GA1UE
CBMHQXJpem9uYTETMBEGA1UEBxMKU2NvdHRzZGFsZTElMCMGA1UEChMcU3RhcmZpZWxkIFRlY2hu
b2xvZ2llcywgSW5jLjE5MDcGA1UECxMwaHR0cDovL2NlcnRpZmljYXRlcy5zdGFyZmllbGR0ZWNo
LmNvbS9yZXBvc2l0b3J5MTEwLwYDVQQDEyhTdGFyZmllbGQgU2VjdXJlIENlcnRpZmljYXRpb24g
QXV0aG9yaXR5MREwDwYDVQQFEwgxMDY4ODQzNTAcFwsxNDAxMDcwMDAwWhcNMTYwNDAxMDcwMDAw
WjCB6zETMBEGCysGAQQBgjc8AgEDEwJVUzEYMBYGCysGAQQBgjc8AgECEwdBcml6b25hMR0wGwYD
VQQPExRQcml2YXRlIE9yZ2FuaXphdGlvbjEUMBIGA1UEBRMLUi0xNzI0NzQxLTYxCzAJBgNVBAYT
AlVTMRAwDgYDVQQIEwdBcml6b25hMRMwEQYDVQQHEwpTY290dHNkYWxlMSQwIgYDVQQKExtTdGFy
ZmllbGQgVGVjaG5vbG9naWVzLCBMTEMxKzApBgNVBAMTInZhbGlkLnNmaS5jYXRlc3Quc3RhcmZp
ZWxkdGVjaC5jb20wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQCt1LHQOza9tkKxwGL+
/yKi/Fe5HM0sjvcM4ic1XVrvpewa4P/04IzGSjIGO3CXaSArxQMSzsTt2dcO9tSJ1Zk8c9NZXM8e
Vqx92iTMEf9OQcubWpzWmrPc3TAFhbVnfEmCptsXEgtxbAIbntrNeDk/hBPdl4DYFYRdm3ZTk4JM
If/quDZe5Oti53J0UsxWXSSoqKyPNdb671Q+OTQfSDj7kVF4+Ri3FIeAV16d2UnpBW1bgNqA5yIT
RskHE4bX98HDNHUTHioHpgA+fXfejWkGB/0FQN4HbZcysYHhf1L5cWBtz9w5J00YmjM5fzWvTc3U
UF9ou7m7JE4aqEbNOWb9AgMBAAGjggHOMIIByjAMBgNVHRMBAf8EAjAAMA4GA1UdDwEB/wQEAwIF
oDAdBgNVHSUEFjAUBggrBgEFBQcDAQYIKwYBBQUHAwIwLQYDVR0RBCYwJIIidmFsaWQuc2ZpLmNh
dGVzdC5zdGFyZmllbGR0ZWNoLmNvbTAdBgNVHQ4EFgQUcO+QEqZcHphPW9szww9ty+1AGmQwHwYD
VR0jBBgwFoAUSUtSJ9EbvPKhIWpie1FCeorX1VYwOAYDVR0fBDEwLzAtoCugKYYnaHR0cDovL2Ny
bC5zdGFyZmllbGR0ZWNoLmNvbS9zZnMzLTAuY3JsMIGNBggrBgEFBQcBAQSBgDB+MCoGCCsGAQUF
BzABhh5odHRwOi8vb2NzcC5zdGFyZmllbGR0ZWNoLmNvbS8wUAYIKwYBBQUHMAKGRGh0dHA6Ly9j
ZXJ0aWZpY2F0ZXMuc3RhcmZpZWxkdGVjaC5jb20vcmVwb3NpdG9yeS9zZl9pbnRlcm1lZGlhdGUu
Y3J0MFIGA1UdIARLMEkwRwYLYIZIAYb9bgEHFwMwODA2BggrBgEFBQcCARYqaHR0cDovL2NlcnRz
LnN0YXJmaWVsZHRlY2guY29tL3JlcG9zaXRvcnkvMA0GCSqGSIb3DQEBBQUAA4IBAQAViYkLUjQk
xWRmZl4DutL0/9/wJSURcJ1qunLP+TImJFp0A9RE/MNKZOmQoAEoH6hMg7FL4etkvTcnruTdcx+3
mvqYiECUiUEx6pkx3dmkYgZACEuk2nfyJ0MkV/zwzqmI8aV+kunpOQv93aePZbrBgaAzkE8jDlEx
td7c4pE7JF40jxmvDwjZHwpyNDULreGtFBij7JcWJCfihM3uetqrao0kOoeih1PQyJXtz2RldhFY
s6Jdk3ILYv+84t5UMO+aS9nVBXIcbgaGjIMZjHDgR/tE9FKFB66k8UTDzAwwEs38VV24zx6hlOzT
F7xAUxmPUnNb2teatMf2Rmj0fs+d
-----END CERTIFICATE-----
';

        $x509 = new X509();

        $cert = $x509->loadX509($test);

        $this->assertEquals($cert['tbsCertificate']['validity']['notBefore']['utcTime'], 'Tue, 07 Jan 2014 00:00:00 +0000');
        $this->assertEquals($cert['tbsCertificate']['validity']['notAfter']['utcTime'], 'Fri, 01 Apr 2016 07:00:00 +0000');
    }

    public function testValidateURL()
    {
        $test = '-----BEGIN CERTIFICATE-----
MIIEgDCCA2igAwIBAgIIPUwrl6kGL2QwDQYJKoZIhvcNAQELBQAwSTELMAkGA1UE
BhMCVVMxEzARBgNVBAoTCkdvb2dsZSBJbmMxJTAjBgNVBAMTHEdvb2dsZSBJbnRl
cm5ldCBBdXRob3JpdHkgRzIwHhcNMTcxMDI0MDkwMjMxWhcNMTcxMjI5MDAwMDAw
WjBoMQswCQYDVQQGEwJVUzETMBEGA1UECAwKQ2FsaWZvcm5pYTEWMBQGA1UEBwwN
TW91bnRhaW4gVmlldzETMBEGA1UECgwKR29vZ2xlIEluYzEXMBUGA1UEAwwOd3d3
Lmdvb2dsZS5jb20wggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQDwFKTU
FgOf1beWoPUuJu8kbwmPBEAPIl933guV6XV54V0rtcc61DZplOzJO4uEyzcGxVqE
A9hKr0CAM/6jBQGZrKm5u6SyqXMPo3qEH2AxsbTx2eIeRIiAt3bDTq2eCilxyM/m
qOvEWAlXPPBFs2B7OBth0xuaSW8+XkNx5ZHIJrNqvh/6INbMVMRzRdQkxz72fiWn
fgtPAC4tBywmzUYTiboJW7poYqIZIxEZCKN0NdzKNOzKpIS1MByByQZECYDCsLVi
gkAuBdo4tT1QNU6KIqKvV716PhQU/ynQA/o7uzjgxO2p/KwaZyD/pihdfLv62qLg
jDBJMU9AfUCWxPmpAgMBAAGjggFLMIIBRzAdBgNVHSUEFjAUBggrBgEFBQcDAQYI
KwYBBQUHAwIwGQYDVR0RBBIwEIIOd3d3Lmdvb2dsZS5jb20waAYIKwYBBQUHAQEE
XDBaMCsGCCsGAQUFBzAChh9odHRwOi8vcGtpLmdvb2dsZS5jb20vR0lBRzIuY3J0
MCsGCCsGAQUFBzABhh9odHRwOi8vY2xpZW50czEuZ29vZ2xlLmNvbS9vY3NwMB0G
A1UdDgQWBBQAl7IbLVzwRb/SsW5jI3gdi7YCqjAMBgNVHRMBAf8EAjAAMB8GA1Ud
IwQYMBaAFErdBhYbvPZotXb1gba7Yhq6WoEvMCEGA1UdIAQaMBgwDAYKKwYBBAHW
eQIFATAIBgZngQwBAgIwMAYDVR0fBCkwJzAloCOgIYYfaHR0cDovL3BraS5nb29n
bGUuY29tL0dJQUcyLmNybDANBgkqhkiG9w0BAQsFAAOCAQEAYJ+3TXE7etCjkLEE
/CN1BKGQVkYoCshZS3FkX8vUBP2orgvu9VGiLN9lb8+LMO+uNMVf+PLNsTP3lQ0q
oFzpU8xsv/87L7UcJoCge2ZR4kANgjmJ12TG7dCcPpbH2qu7Y8wnWubik5U68gsI
Qopg3hKg24p645o4exwsd/lOrsqh3vPorwZwU2Ekd2wKdxBID3puQA1jvWOBUcJI
Oe2K7+R2Cf6p8bYmm3OABuYkvO8D+u8gIdIO5cP+ic+SDOGVNJaT949YPes/S99R
9NQRFKcjEPl1UYh5bpPTKYzS7cTcDYG6xvbtG/XKEsK5U9UggzY6PCOPDDYpF+rq
C47x9g==
-----END CERTIFICATE-----';

        $x509 = new X509();

        $cert = $x509->loadX509($test);

        $this->assertTrue($x509->validateURL('https://www.google.com'));
    }

    public function testValidateSignatureWithoutKeyIdentifier()
    {
        $x509 = new X509();
        $x509->loadX509('-----BEGIN CERTIFICATE-----
MIIDATCCAmqgAwIBAgICApowDQYJKoZIhvcNAQEFBQAwdzELMAkGA1UEBhMCVUsx
DzANBgNVBAgMBkxvbmRvbjEPMA0GA1UEBwwGTG9uZG9uMQwwCgYDVQQKDANNUFMx
DDAKBgNVBAsMA0RldjENMAsGA1UEAwwEdGVzdDEbMBkGCSqGSIb3DQEJARYMZGVr
aUBtcHMuY29tMB4XDTE3MTEyNDE4MzE0MFoXDTE4MTEyNDE4MzE0MFowYTELMAkG
A1UEBhMCVUsxDzANBgNVBAgMBkxvbmRvbjEPMA0GA1UEBwwGTG9uZG9uMQwwCgYD
VQQKDANNUFMxETAPBgNVBAsMCERldi90ZXN0MQ8wDQYDVQQDDAZ0ZXN0MDEwgZ8w
DQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAJ6+ydLXtjwbKhUBIodrm9Zq5yhhfMUM
IDhpcEZ2PAWWUiwKZOo9eyXGAv4LnpvDcX5GzThqI1g3/rcPjgBMOB8bcuQA6RE0
I9Jcf3YHbg/ednp7Q2X/zqUW+QUd01VfG8OJiRvO/4WKJTdQMU7/DKAv5WScIa4c
0b11X4iiLUVvAgMBAAGjgbEwga4wgZMGA1UdIwSBizCBiKF7pHkwdzELMAkGA1UE
BhMCVUsxDzANBgNVBAgMBkxvbmRvbjEPMA0GA1UEBwwGTG9uZG9uMQwwCgYDVQQK
DANNUFMxDDAKBgNVBAsMA0RldjENMAsGA1UEAwwEdGVzdDEbMBkGCSqGSIb3DQEJ
ARYMZGVraUBtcHMuY29tggkA+Fj4n7pGuRMwCQYDVR0TBAIwADALBgNVHQ8EBAMC
BPAwDQYJKoZIhvcNAQEFBQADgYEAK0s83KbLM0OSj93/aly7UZHKGY3R/XhBNcsQ
3fcxzX6VX8naJpqfK9kM5Ry9IBnqu6LwCnk18kqt6V6PSjqQ3gj9S3x8znTMdus1
xraMNBOqRrn9quWCGEQt/iBrXHZ8zCdb4a+Eb5Jhz6/qK00KVufxw67fhuvhsjjv
nnA8of4=
-----END CERTIFICATE-----');

        $authorityKeyIdentifier = $x509->getExtension('id-ce-authorityKeyIdentifier');
        $this->assertNotNull($authorityKeyIdentifier);
        $this->assertFalse(isset($authorityKeyIdentifier['keyIdentifier']));

        $x509->loadCA('-----BEGIN CERTIFICATE-----
MIIDITCCAoqgAwIBAgIJAPhY+J+6RrkTMA0GCSqGSIb3DQEBBQUAMHcxCzAJBgNV
BAYTAlVLMQ8wDQYDVQQIDAZMb25kb24xDzANBgNVBAcMBkxvbmRvbjEMMAoGA1UE
CgwDTVBTMQwwCgYDVQQLDANEZXYxDTALBgNVBAMMBHRlc3QxGzAZBgkqhkiG9w0B
CQEWDGRla2lAbXBzLmNvbTAeFw0xNzExMjQxODI3NDlaFw0xODExMjQxODI3NDla
MHcxCzAJBgNVBAYTAlVLMQ8wDQYDVQQIDAZMb25kb24xDzANBgNVBAcMBkxvbmRv
bjEMMAoGA1UECgwDTVBTMQwwCgYDVQQLDANEZXYxDTALBgNVBAMMBHRlc3QxGzAZ
BgkqhkiG9w0BCQEWDGRla2lAbXBzLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAw
gYkCgYEA022CwduFLxKCwwKp2WTTpBu1vhcVywOAW0rNIfuSa7XsYyX5rCSScE4d
YW8hUgWbZSoJMk1s1omZarmwMAIeknpigZSKWUhEJF3IVnc1tW3mGaSAEvKg6r4g
unKttJV2aDW8w3Ew2qzP0G8sJwMX7y49XQumG5IgpuVXkiydTwsCAwEAAaOBtDCB
sTCBkwYDVR0jBIGLMIGIoXukeTB3MQswCQYDVQQGEwJVSzEPMA0GA1UECAwGTG9u
ZG9uMQ8wDQYDVQQHDAZMb25kb24xDDAKBgNVBAoMA01QUzEMMAoGA1UECwwDRGV2
MQ0wCwYDVQQDDAR0ZXN0MRswGQYJKoZIhvcNAQkBFgxkZWtpQG1wcy5jb22CCQD4
WPifuka5EzAMBgNVHRMEBTADAQH/MAsGA1UdDwQEAwIE8DANBgkqhkiG9w0BAQUF
AAOBgQBNhIESJpRiYBPDdIsdfOyuclzmN+5KHXicAXN4WXFiYgVQhML44Vb7Macb
X5ZBGsa3olRvoKrhg8ian7NyfRviAk0iO8EAAFCeeYHPN6bbloGfUcuf72P8576w
HI8pYRZmT7tKW3HxlZLJGGVo5CgBawdiWngK5v+LwWiNRTqxJA==
-----END CERTIFICATE-----');

        $this->assertTrue($x509->validateSignature());
    }

    public function testValidateSignatureSelfSignedWithoutKeyIdentifier()
    {
        $x509 = new X509();
        $x509->loadX509('-----BEGIN CERTIFICATE-----
MIIDITCCAoqgAwIBAgIJAPhY+J+6RrkTMA0GCSqGSIb3DQEBBQUAMHcxCzAJBgNV
BAYTAlVLMQ8wDQYDVQQIDAZMb25kb24xDzANBgNVBAcMBkxvbmRvbjEMMAoGA1UE
CgwDTVBTMQwwCgYDVQQLDANEZXYxDTALBgNVBAMMBHRlc3QxGzAZBgkqhkiG9w0B
CQEWDGRla2lAbXBzLmNvbTAeFw0xNzExMjQxODI3NDlaFw0xODExMjQxODI3NDla
MHcxCzAJBgNVBAYTAlVLMQ8wDQYDVQQIDAZMb25kb24xDzANBgNVBAcMBkxvbmRv
bjEMMAoGA1UECgwDTVBTMQwwCgYDVQQLDANEZXYxDTALBgNVBAMMBHRlc3QxGzAZ
BgkqhkiG9w0BCQEWDGRla2lAbXBzLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAw
gYkCgYEA022CwduFLxKCwwKp2WTTpBu1vhcVywOAW0rNIfuSa7XsYyX5rCSScE4d
YW8hUgWbZSoJMk1s1omZarmwMAIeknpigZSKWUhEJF3IVnc1tW3mGaSAEvKg6r4g
unKttJV2aDW8w3Ew2qzP0G8sJwMX7y49XQumG5IgpuVXkiydTwsCAwEAAaOBtDCB
sTCBkwYDVR0jBIGLMIGIoXukeTB3MQswCQYDVQQGEwJVSzEPMA0GA1UECAwGTG9u
ZG9uMQ8wDQYDVQQHDAZMb25kb24xDDAKBgNVBAoMA01QUzEMMAoGA1UECwwDRGV2
MQ0wCwYDVQQDDAR0ZXN0MRswGQYJKoZIhvcNAQkBFgxkZWtpQG1wcy5jb22CCQD4
WPifuka5EzAMBgNVHRMEBTADAQH/MAsGA1UdDwQEAwIE8DANBgkqhkiG9w0BAQUF
AAOBgQBNhIESJpRiYBPDdIsdfOyuclzmN+5KHXicAXN4WXFiYgVQhML44Vb7Macb
X5ZBGsa3olRvoKrhg8ian7NyfRviAk0iO8EAAFCeeYHPN6bbloGfUcuf72P8576w
HI8pYRZmT7tKW3HxlZLJGGVo5CgBawdiWngK5v+LwWiNRTqxJA==
-----END CERTIFICATE-----');

        $authorityKeyIdentifier = $x509->getExtension('id-ce-authorityKeyIdentifier');
        $this->assertNotNull($authorityKeyIdentifier);
        $this->assertFalse(isset($authorityKeyIdentifier['keyIdentifier']));

        $this->assertTrue($x509->validateSignature(false));
    }

    /**
     * @group github1243
     */
    public function testExtensionRemoval()
    {
        // Load the CA and its private key.
        $pemcakey = '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQCpKtNFBdtRd8eFcq7L7RxvkeeUFcc4QDY6rLDJUpPGp1qL9L7p
l+rK0L66TGSs+wZTM4awDP2d75HZG2/9LOX5Xy4oAb7aS2PiLDQmVa81t1sA42bs
3UBxak9w4jcj623gesDG6dN1sFpqVq9/Z4JOnPJu1PXzwcuj3t7J5QLFSwIDAQAB
AoGBAI8/vHeOZhGupD3Uxz/YIWQ44Sj86B4yAbnd0jYovwpRXNN3BNM52ZC1A00u
s3Hnf4uk7kDWP00mORLnsQVqp7IKMznTHyvBJ/uA5vipXc0fmpmmPLjy6Sh071Co
0iTYFUDu3dlPi6UEgQ6ZjgXmHdeTRA/YuH/70sqKjLjkYRbBAkEA3oRoMdJjJAm4
+XY3+1Ulc2qTHkecsTOON0Reta9THws4ibtKIP89aBUthz1XGLm9mUtWu49kQXht
o1FtFLhLtQJBAMKfUurb075FQIRl6KsRJilCWVJSplf0szvKWm40uDXYmFlj7D7J
bEdbVBWdfBi9SNzZrLAThjfxwdBsr+DjbP8CQQCeft+cxUfazpYUErHTcxXG/R2n
jsi8q4VcNnXjoetqDFsMN/yYPlYmAhe44edc9EhpnXE9DekSfU5S61fwT0mVAkAm
keSg3sfr4VWT545guJlTe+6vvelxbPFIXCXnyVLoePBYZtEe8FQhIBxd3EQHsxuJ
iSoMCxKCa8r5P1DrxKaJAkBBP87OdahRq0CBQjTFg0wmPs66PoTXA4hZvSxV77CO
tMPj6Pas7Muejogm6JkmxXC/uT6Tzfknd0B3XSmtDzGL
-----END RSA PRIVATE KEY-----';
        $cakey = new RSA();
        $cakey->loadKey($pemcakey);
        $pemca = '-----BEGIN CERTIFICATE-----
MIICADCCAWmgAwIBAgIUJXQulcz5xkTam8UGC/yn6iVaiWwwDQYJKoZIhvcNAQEF
BQAwHDEaMBgGA1UECgwRcGhwc2VjbGliIGRlbW8gQ0EwHhcNMTgwMTIxMTc0NzM0
WhcNMTkwMTIxMTc0NzM0WjAcMRowGAYDVQQKDBFwaHBzZWNsaWIgZGVtbyBDQTCB
nzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEAqSrTRQXbUXfHhXKuy+0cb5HnlBXH
OEA2OqywyVKTxqdai/S+6ZfqytC+ukxkrPsGUzOGsAz9ne+R2Rtv/Szl+V8uKAG+
2ktj4iw0JlWvNbdbAONm7N1AcWpPcOI3I+tt4HrAxunTdbBaalavf2eCTpzybtT1
88HLo97eyeUCxUsCAwEAAaM/MD0wCwYDVR0PBAQDAgEGMA8GA1UdEwEB/wQFMAMB
Af8wHQYDVR0OBBYEFCS1BJ12nN8ObQWE4OgOOSH9DxTRMA0GCSqGSIb3DQEBBQUA
A4GBAHkSnlJnlkwDEUcENKWFZpfNgZu9HUvEuLDVOnhvsdd2MDr8EbVbgMHYNWnV
+ZOS/dqbuCd9Vd27JsBC2YHklaq9/V5zMbrEBiMLo5P5WL9qrz0qbmK/aruP+VX7
cKVMm1WnOQd4aQgCvzv2r7/gsdX++496vRpBMTfwa1qLBjG6
-----END CERTIFICATE-----';
        $ca = new X509();
        $ca->loadX509($pemca);
        $ca->setPrivateKey($cakey);

        // Read the old certificate.
        $oldcert = new X509();
        $oldcert->loadCA($pemca);
        $oldcert->loadX509('-----BEGIN CERTIFICATE-----
MIIB+TCCAWKgAwIBAgIUW+D7X27oKXHaD6WqFjelccV+D4YwDQYJKoZIhvcNAQEF
BQAwHDEaMBgGA1UECgwRcGhwc2VjbGliIGRlbW8gQ0EwHhcNMTgwMTIxMTc0NzM0
WhcNMTkwMTIxMTc0NzM0WjA3MRwwGgYDVQQKDBNwaHBzZWNsaWIgZGVtbyBjZXJ0
MRcwFQYDVQQDDA53d3cuZ29vZ2xlLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAw
gYkCgYEAqnB0IyO+O6RcZdZooFaMKY/ggeNPXW/EaLXdciHEnzxgbsVb1I5m5pwy
nZIf6RCHUsfOYdhTX/xQE8JOSkbDEYtKmrySxu+JpmR3qZPhL+4rJUJKCdI+9YbM
z1wiqQeHhVUTPiEvgdAzkzPXcrkLmpb1KV7VhKoQ4Z3swmJX528CAwEAAaMdMBsw
GQYDVR0RBBIwEIIOd3d3Lmdvb2dsZS5jb20wDQYJKoZIhvcNAQEFBQADgYEAV5W5
G9eY1SJiwIHMcd5Eo41w+bN69EqOJhTY28LQc/m9i+Fuc1J6nkwDMKCtEeEUyhjl
bEbVUszdgPQWON7Y2nS5OCb2BevxW8Xdf6gnf/PRRYmlZJgygwf0KpgSm5CxxsZW
Fqfy+n5VpXOdrjic4yZ52yS5sUaq05s6ZZvnmdU=
-----END CERTIFICATE-----');
        $this->assertTrue($oldcert->validateSignature());

        // Set new dates and serial number.
        $newcert = new X509();
        $newcert->setStartDate('-1 day');
        $newcert->setEndDate('+2 years');
        //$newcert->setSerialNumber('1234', 10);

        $oldcert->setDomain('www.google.com');

        // Produce the new certificate by signing the old one.
        $crt = $newcert->loadX509($newcert->saveX509($newcert->sign($ca, $oldcert)));

        // Output new certificate.
        $newcert->saveX509($crt);
    }

    public function testAuthorityInfoAccess()
    {
        $x509 = new X509();
        $x509->loadCA('-----BEGIN CERTIFICATE-----
MIIDrzCCApegAwIBAgIQCDvgVpBCRrGhdWrJWZHHSjANBgkqhkiG9w0BAQUFADBh
MQswCQYDVQQGEwJVUzEVMBMGA1UEChMMRGlnaUNlcnQgSW5jMRkwFwYDVQQLExB3
d3cuZGlnaWNlcnQuY29tMSAwHgYDVQQDExdEaWdpQ2VydCBHbG9iYWwgUm9vdCBD
QTAeFw0wNjExMTAwMDAwMDBaFw0zMTExMTAwMDAwMDBaMGExCzAJBgNVBAYTAlVT
MRUwEwYDVQQKEwxEaWdpQ2VydCBJbmMxGTAXBgNVBAsTEHd3dy5kaWdpY2VydC5j
b20xIDAeBgNVBAMTF0RpZ2lDZXJ0IEdsb2JhbCBSb290IENBMIIBIjANBgkqhkiG
9w0BAQEFAAOCAQ8AMIIBCgKCAQEA4jvhEXLeqKTTo1eqUKKPC3eQyaKl7hLOllsB
CSDMAZOnTjC3U/dDxGkAV53ijSLdhwZAAIEJzs4bg7/fzTtxRuLWZscFs3YnFo97
nh6Vfe63SKMI2tavegw5BmV/Sl0fvBf4q77uKNd0f3p4mVmFaG5cIzJLv07A6Fpt
43C/dxC//AH2hdmoRBBYMql1GNXRor5H4idq9Joz+EkIYIvUX7Q6hL+hqkpMfT7P
T19sdl6gSzeRntwi5m3OFBqOasv+zbMUZBfHWymeMr/y7vrTC0LUq7dBMtoM1O/4
gdW7jVg/tRvoSSiicNoxBN33shbyTApOB6jtSj1etX+jkMOvJwIDAQABo2MwYTAO
BgNVHQ8BAf8EBAMCAYYwDwYDVR0TAQH/BAUwAwEB/zAdBgNVHQ4EFgQUA95QNVbR
TLtm8KPiGxvDl7I90VUwHwYDVR0jBBgwFoAUA95QNVbRTLtm8KPiGxvDl7I90VUw
DQYJKoZIhvcNAQEFBQADggEBAMucN6pIExIK+t1EnE9SsPTfrgT1eXkIoyQY/Esr
hMAtudXH/vTBH1jLuG2cenTnmCmrEbXjcKChzUyImZOMkXDiqw8cvpOp/2PV5Adg
06O/nVsJ8dWO41P0jmP6P6fbtGbfYmbW0W5BjfIttep3Sp+dWOIrWcBAI+0tKIJF
PnlUkiaY4IBIqDfv8NZ5YBberOgOzW6sRBc4L0na4UU+Krk2U886UAb3LujEV0ls
YSEY1QSteDwsOoBrp+uvFRTp2InBuThs4pFsiv9kuXclVzDAGySj4dzp30d8tbQk
CAUw7C29C79Fv1C5qfPrmAESrciIxpg0X40KPMbp1ZWVbd4=
-----END CERTIFICATE-----');
        $x509->loadX509('-----BEGIN CERTIFICATE-----
MIIG3TCCBcWgAwIBAgIQAtB7LVsRCmgbyWiiw7Sf5jANBgkqhkiG9w0BAQsFADBN
MQswCQYDVQQGEwJVUzEVMBMGA1UEChMMRGlnaUNlcnQgSW5jMScwJQYDVQQDEx5E
aWdpQ2VydCBTSEEyIFNlY3VyZSBTZXJ2ZXIgQ0EwHhcNMTcwOTEzMDAwMDAwWhcN
MTkwOTEzMTIwMDAwWjBqMQswCQYDVQQGEwJVUzETMBEGA1UECBMKV2FzaGluZ3Rv
bjEQMA4GA1UEBxMHUmVkbW9uZDEeMBwGA1UEChMVTWljcm9zb2Z0IENvcnBvcmF0
aW9uMRQwEgYDVQQDEwtvdXRsb29rLmNvbTCCASIwDQYJKoZIhvcNAQEBBQADggEP
ADCCAQoCggEBAIz2tovvgBmK4sOHgpyzCdtXrI0XOujctf6LHMj16wzUnMEatioS
tH0Pz0dKkCr/0yd9qtXbGhD1o6WhFsd7k651K9MZ98+uQ29SzTIAl6y1gkaBbp4h
MFXcE5EpRNHHmK8t2OR7hzmrvvNr6OTYv7BhVCw9pSrQqEFNno0K2TQRhAD9uzrL
OY+rBBVedCXWXH7uhZoZ6joUU7CEA5pPMzKPL1ro+Eorc8vt5FYOC+oAT587+b1M
z+jbZVQlq0qaMkBKRtUIII78MYY0n8DopGqHyzwqWoGySHJNC8256q+MwsZQvvQ3
vmy/rf61h2sg1tU0s7O88Yufxp0LSaMMzZcCAwEAAaOCA5owggOWMB8GA1UdIwQY
MBaAFA+AYRyCMWHVLyjnjUY4tCzhxtniMB0GA1UdDgQWBBT7hLoZ/03rqwcslIc2
0k0z2R+vNTCCAdwGA1UdEQSCAdMwggHPggtvdXRsb29rLmNvbYIWKi5jbG8uZm9v
dHByaW50ZG5zLmNvbYIWKi5ucmIuZm9vdHByaW50ZG5zLmNvbYIgYXR0YWNobWVu
dC5vdXRsb29rLm9mZmljZXBwZS5uZXSCG2F0dGFjaG1lbnQub3V0bG9vay5saXZl
Lm5ldIIdYXR0YWNobWVudC5vdXRsb29rLm9mZmljZS5uZXSCHWNjcy5sb2dpbi5t
aWNyb3NvZnRvbmxpbmUuY29tgiFjY3Mtc2RmLmxvZ2luLm1pY3Jvc29mdG9ubGlu
ZS5jb22CC2hvdG1haWwuY29tgg0qLmhvdG1haWwuY29tggoqLmxpdmUuY29tghZt
YWlsLnNlcnZpY2VzLmxpdmUuY29tgg1vZmZpY2UzNjUuY29tgg8qLm9mZmljZTM2
NS5jb22CFyoub3V0bG9vay5vZmZpY2UzNjUuY29tgg0qLm91dGxvb2suY29tghYq
LmludGVybmFsLm91dGxvb2suY29tggwqLm9mZmljZS5jb22CEm91dGxvb2sub2Zm
aWNlLmNvbYIUc3Vic3RyYXRlLm9mZmljZS5jb22CGHN1YnN0cmF0ZS1zZGYub2Zm
aWNlLmNvbTAOBgNVHQ8BAf8EBAMCBaAwHQYDVR0lBBYwFAYIKwYBBQUHAwEGCCsG
AQUFBwMCMGsGA1UdHwRkMGIwL6AtoCuGKWh0dHA6Ly9jcmwzLmRpZ2ljZXJ0LmNv
bS9zc2NhLXNoYTItZzEuY3JsMC+gLaArhilodHRwOi8vY3JsNC5kaWdpY2VydC5j
b20vc3NjYS1zaGEyLWcxLmNybDBMBgNVHSAERTBDMDcGCWCGSAGG/WwBATAqMCgG
CCsGAQUFBwIBFhxodHRwczovL3d3dy5kaWdpY2VydC5jb20vQ1BTMAgGBmeBDAEC
AjB8BggrBgEFBQcBAQRwMG4wJAYIKwYBBQUHMAGGGGh0dHA6Ly9vY3NwLmRpZ2lj
ZXJ0LmNvbTBGBggrBgEFBQcwAoY6aHR0cDovL2NhY2VydHMuZGlnaWNlcnQuY29t
L0RpZ2lDZXJ0U0hBMlNlY3VyZVNlcnZlckNBLmNydDAMBgNVHRMBAf8EAjAAMA0G
CSqGSIb3DQEBCwUAA4IBAQA3zjN7I6jTeL+08nhG5eAY0q4pLY40bCQHqONBLSI3
uRmQFUfrQOPYBqLC1QU+J2Z2HcX7YiqE3WAR3ODS9g2BAVXkKOQKNBnr2hKwueOz
qPwyvTyzcIQYUw+SrTX+bfJwYMTmZvtP9S7/pB1jPhrV7YGsD55AI9bGa9cmH7VQ
OiL1p5Qovg5KRsldoZeC04OF/UQIR1fv47VGptsHHGypvSo1JinJFQMXylqLIrUW
lV66p3Ui7pFABGc/Lv7nOyANXfLugBO8MyzydGA4NRGiS2MbGpswPCg154pWausU
M0qaEPsM2o3CSTfxSJQQIyEe+izV3UQqYSyWkNqCCFPN
-----END CERTIFICATE-----');

        X509::setRecurLimit(0);
        $this->assertFalse($x509->validateSignature());

        X509::setRecurLimit(5);
        $this->assertTrue($x509->validateSignature());
    }

    public function testValidateDate()
    {
        $x509 = new X509();
        $x509->loadX509('-----BEGIN CERTIFICATE-----
MIIDITCCAoqgAwIBAgIQT52W2WawmStUwpV8tBV9TTANBgkqhkiG9w0BAQUFADBM
MQswCQYDVQQGEwJaQTElMCMGA1UEChMcVGhhd3RlIENvbnN1bHRpbmcgKFB0eSkg
THRkLjEWMBQGA1UEAxMNVGhhd3RlIFNHQyBDQTAeFw0xMTEwMjYwMDAwMDBaFw0x
MzA5MzAyMzU5NTlaMGgxCzAJBgNVBAYTAlVTMRMwEQYDVQQIEwpDYWxpZm9ybmlh
MRYwFAYDVQQHFA1Nb3VudGFpbiBWaWV3MRMwEQYDVQQKFApHb29nbGUgSW5jMRcw
FQYDVQQDFA53d3cuZ29vZ2xlLmNvbTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkC
gYEA3rcmQ6aZhc04pxUJuc8PycNVjIjujI0oJyRLKl6g2Bb6YRhLz21ggNM1QDJy
wI8S2OVOj7my9tkVXlqGMaO6hqpryNlxjMzNJxMenUJdOPanrO/6YvMYgdQkRn8B
d3zGKokUmbuYOR2oGfs5AER9G5RqeC1prcB6LPrQ2iASmNMCAwEAAaOB5zCB5DAM
BgNVHRMBAf8EAjAAMDYGA1UdHwQvMC0wK6ApoCeGJWh0dHA6Ly9jcmwudGhhd3Rl
LmNvbS9UaGF3dGVTR0NDQS5jcmwwKAYDVR0lBCEwHwYIKwYBBQUHAwEGCCsGAQUF
BwMCBglghkgBhvhCBAEwcgYIKwYBBQUHAQEEZjBkMCIGCCsGAQUFBzABhhZodHRw
Oi8vb2NzcC50aGF3dGUuY29tMD4GCCsGAQUFBzAChjJodHRwOi8vd3d3LnRoYXd0
ZS5jb20vcmVwb3NpdG9yeS9UaGF3dGVfU0dDX0NBLmNydDANBgkqhkiG9w0BAQUF
AAOBgQAhrNWuyjSJWsKrUtKyNGadeqvu5nzVfsJcKLt0AMkQH0IT/GmKHiSgAgDp
ulvKGQSy068Bsn5fFNum21K5mvMSf3yinDtvmX3qUA12IxL/92ZzKbeVCq3Yi7Le
IOkKcGQRCMha8X2e7GmlpdWC1ycenlbN0nbVeSv3JUMcafC4+Q==
-----END CERTIFICATE-----');

        $this->assertFalse($x509->validateDate('Nov 22, 2018'));
        $this->assertTrue($x509->validateDate('Nov 22, 2012'));
    }

    public function testLongTagOnBadCert()
    {
        // the problem with this cert is that it'd cause an infinite loop
        $x509 = new X509();
        $r = @$x509->loadX509('-----BEGIN CERTIFICATE-----
MIIBjDCCATGgAwIBAgIJAJSiNCIEEiyyMAoGCCqGSM49BAMCMA0xCzAJBgNVBAMM
AkNBMB4XDTE5MDUwOTAzMTUzMFoXDTE5MDYwODAzMTUzMFowDTELMAkGA1UEAwwC
Q0FNRmt3RXdZSEtvWkl6ajBDQVFZSUtvWkl6ajBEQVFjRFFnQUU4K0R0TDM0Syt0
RzZGR3o2QXJ2QzlySnlmN1Y5N09wY3ZWeG1IbjRXQStXc0E2L0dxLzZ1cUFBdG5Y
RDZOQUxsRVVSVFZCcmlvNjB4L0xZN1ZoTmx0UT09o1kwVzAgBgNVHQ4BAf8EFgQU
25GbjmtucxjEGkWrB2R6AB6/yrkwIgYDVR0jAQH/BBgwFoAU25GbjmtucxjEGkWr
B2R6AB6/yrkwDwYDVR0TAQH/BAUwAwEB/zAKBggqhkjOPQQDAgNJADBGAiEA6ZB6
+KlUM1ZXFrxtDxLWqp51myWDulWjnK6cl7b5AVgCIQCRdthTn8JlN5bRSnJ6qiCk
A9bhRA0cVk7bAEU2c44CYg==
-----END CERTIFICATE-----');

        $this->assertFalse($r);
    }

    /**
     * @group github1387
     */
    public function testNameConstraintIP()
    {
        $x509 = new X509();
        $r = $x509->loadX509('-----BEGIN CERTIFICATE-----
MIIGcDCCBVigAwIBAgIQRUgJC4ec7yFWcqzT3mwbWzANBgkqhkiG9w0BAQwFADB1MQswCQYDVQQG
EwJFRTEiMCAGA1UECgwZQVMgU2VydGlmaXRzZWVyaW1pc2tlc2t1czEoMCYGA1UEAwwfRUUgQ2Vy
dGlmaWNhdGlvbiBDZW50cmUgUm9vdCBDQTEYMBYGCSqGSIb3DQEJARYJcGtpQHNrLmVlMCAXDTE1
MTIxNzEyMzg0M1oYDzIwMzAxMjE3MjM1OTU5WjBjMQswCQYDVQQGEwJFRTEiMCAGA1UECgwZQVMg
U2VydGlmaXRzZWVyaW1pc2tlc2t1czEXMBUGA1UEYQwOTlRSRUUtMTA3NDcwMTMxFzAVBgNVBAMM
DkVTVEVJRC1TSyAyMDE1MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEA0oH61NDxbdW9
k8nLA1qGaL4B7vydod2Ewp/STBZB3wEtIJCLdkpEsS8pXfFiRqwDVsgGGbu+Q99trlb5LI7yi7rI
kRov5NftBdSNPSU5rAhYPQhvZZQgOwRaHa5Ey+BaLJHmLqYQS9hQvQsCYyws+xVvNFUpK0pGD64i
ycqdMuBl/nWq3fLuZppwBh0VFltm4nhr/1S0R9TRJpqFUGbGr4OK/DwebQ5PjhdS40gCUNwmC7fP
Q4vIH+x+TCk2aG+u3MoAz0IrpVWqiwzG/vxreuPPAkgXeFCeYf6fXLsGz4WivsZFbph2pMjELu6s
ltlBXfAG3fGv43t91VXicyzR/eT5dsB+zFsW1sHV+1ONPr+qzgDxCH2cmuqoZNfIIq+buob3eA8e
e+XpJKJQr+1qGrmhggjvAhc7m6cU4x/QfxwRYhIVNhJf+sKVThkQhbJ9XxuKk3c18wymwL1mpDD0
PIGJqlssMeiuJ4IzagFbgESGNDUd4icm0hQT8CmQeUm1GbWeBYseqPhMQX97QFBLXJLVy2SCyoAz
7Bq1qA43++EcibN+yBc1nQs2Zoq8ck9MK0bCxDMeUkQUz6VeQGp69ImOQrsw46qTz0mtdQrMSbnk
XCuLan5dPm284J9HmaqiYi6j6KLcZ2NkUnDQFesBVlMEm+fHa2iR6lnAFYZ06UECAwEAAaOCAgow
ggIGMB8GA1UdIwQYMBaAFBLyWj7qVhy/zQas8fElyalL1BSZMB0GA1UdDgQWBBSzq4i8mdVipIUq
CM20HXI7g3JHUTAOBgNVHQ8BAf8EBAMCAQYwdwYDVR0gBHAwbjAIBgYEAI96AQIwCQYHBACL7EAB
AjAwBgkrBgEEAc4fAQEwIzAhBggrBgEFBQcCARYVaHR0cHM6Ly93d3cuc2suZWUvQ1BTMAsGCSsG
AQQBzh8BAjALBgkrBgEEAc4fAQMwCwYJKwYBBAHOHwEEMBIGA1UdEwEB/wQIMAYBAf8CAQAwQQYD
VR0eBDowOKE2MASCAiIiMAqHCAAAAAAAAAAAMCKHIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
AAAAAAAAMCcGA1UdJQQgMB4GCCsGAQUFBwMJBggrBgEFBQcDAgYIKwYBBQUHAwQwfAYIKwYBBQUH
AQEEcDBuMCAGCCsGAQUFBzABhhRodHRwOi8vb2NzcC5zay5lZS9DQTBKBggrBgEFBQcwAoY+aHR0
cDovL3d3dy5zay5lZS9jZXJ0cy9FRV9DZXJ0aWZpY2F0aW9uX0NlbnRyZV9Sb290X0NBLmRlci5j
cnQwPQYDVR0fBDYwNDAyoDCgLoYsaHR0cDovL3d3dy5zay5lZS9yZXBvc2l0b3J5L2NybHMvZWVj
Y3JjYS5jcmwwDQYJKoZIhvcNAQEMBQADggEBAHRWDGI3P00r2sOnlvLHKk9eE7X93eT+4e5TeaQs
OpE5zQRUTtshxN8Bnx2ToQ9rgi18q+MwXm2f0mrGakYYG0bix7ZgDQvCMD/kuRYmwLGdfsTXwh8K
uL6uSHF+U/ZTss6qG7mxCHG9YvebkN5Yj/rYRvZ9/uJ9rieByxw4wo7b19p22PXkAkXP5y3+qK/O
et98lqwI97kJhiS2zxFYRk+dXbazmoVHnozYKmsZaSUvoYNNH19tpS7BLdsgi9KpbvQLb5ywIMq9
ut3+b2Xvzq8yzmHMFtLIJ6Afu1jJpqD82BUAFcvi5vhnP8M7b974R18WCOpgNQvXDI+2/8ZINeU=
-----END CERTIFICATE-----');
        $r = $x509->saveX509($r);
        $r = $x509->loadX509($r);
        $this->assertSame($r['tbsCertificate']['extensions'][5]['extnValue']['excludedSubtrees'][1]['base']['iPAddress'], array('0.0.0.0', '0.0.0.0'));
    }

    /**
     * @group github1456
     */
    public function testRandomString()
    {
        $a = 'da7e705569d4196cd49cf3b3d92cd435ca34ccbe';
        $a = pack('H*', $a);

        $x509 = new X509();
        $r = $x509->loadX509($a);

        $this->assertFalse($r);
    }

    /**
     * @group github1542
     */
    public function testMultiCertPEM()
    {
        $a = '-----BEGIN CERTIFICATE-----
MIILODCCCSCgAwIBAgIQDh0LGipJ++wxFLj8X5MXKDANBgkqhkiG9w0BAQsFADCB
kDELMAkGA1UEBhMCVVMxDTALBgNVBAgTBFV0YWgxDTALBgNVBAcTBExlaGkxFzAV
BgNVBAoTDkRpZ2lDZXJ0LCBJbmMuMRkwFwYDVQQLExB3d3cuZGlnaWNlcnQuY29t
MS8wLQYDVQQDEyZEaWdpQ2VydCBWZXJpZmllZCBNYXJrIEludGVybWVkaWF0ZSBD
QTAeFw0yMDA3MzAwMDAwMDBaFw0yMTAxMjUxMjAwMDBaMIIBDjEdMBsGA1UEDxMU
UHJpdmF0ZSBPcmdhbml6YXRpb24xEzARBgsrBgEEAYI3PAIBAxMCVVMxGTAXBgsr
BgEEAYI3PAIBAhMIRGVsYXdhcmUxEDAOBgNVBAUTBzM2MzMwMTkxGTAXBgNVBAkT
EDEwMDAgVyBNYXVkZSBBdmUxDjAMBgNVBBETBTk0MDg1MQswCQYDVQQGEwJVUzET
MBEGA1UECBMKQ2FsaWZvcm5pYTESMBAGA1UEBxMJU3Vubnl2YWxlMR0wGwYDVQQK
ExRMaW5rZWRJbiBDb3Jwb3JhdGlvbjESMBAGCisGAQQBg55fAQMTAlVTMRcwFQYK
KwYBBAGDnl8BBBMHNTY3NTczOTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoC
ggEBAOCl7WccAcvSaf5+pNsV82VjFuwdzEwjDYESZmIuurz95e+JtJZst/M3Hw90
YxKSDV4LdaVFAogXy2F+Npit1KhbBEb8vbBkm4LJ3iM8teE/10JugLyxrcVi3LSj
iKHs+rqxcTJsVYoR+CuPLuAbu4xKi+xQ4tVafrFd0Y21n6OL8nB2SRISHF58kRXq
UDW/NippF1AhcdCc5L5EmXFPCpyWfv+UXgTj9i+/I9AWUC3diHckb5NXd/wS7Jmq
5FE0uixRGTixI5a9uZr0jasTtfhlVtvqFyDmzARB/q9IU0eXm3dtcCJISIXGum6o
yCFUk8pyYsGd/M5Fyw7zbmEqsucCAwEAAaOCBgswggYHMB8GA1UdIwQYMBaAFOsN
zmX0UnV7TbPUsz0w41AYq+NuMB0GA1UdDgQWBBSkuL0+t0wu/+y2xkUY/FOSsiuV
ODAXBgNVHREEEDAOggxsaW5rZWRpbi5jb20wEwYDVR0lBAwwCgYIKwYBBQUHAx8w
gZkGA1UdHwSBkTCBjjBFoEOgQYY/aHR0cDovL2NybDMuZGlnaWNlcnQuY29tL0Rp
Z2lDZXJ0VmVyaWZpZWRNYXJrSW50ZXJtZWRpYXRlQ0EuY3JsMEWgQ6BBhj9odHRw
Oi8vY3JsNC5kaWdpY2VydC5jb20vRGlnaUNlcnRWZXJpZmllZE1hcmtJbnRlcm1l
ZGlhdGVDQS5jcmwwUAYDVR0gBEkwRzA3BglghkgBhv1sCgEwKjAoBggrBgEFBQcC
ARYcaHR0cHM6Ly93d3cuZGlnaWNlcnQuY29tL0NQUzAMBgorBgEEAYOeXwEBMF4G
CCsGAQUFBwEBBFIwUDBOBggrBgEFBQcwAoZCaHR0cDovL2NhY2VydHMuZGlnaWNl
cnQuY29tL0RpZ2lDZXJ0VmVyaWZpZWRNYXJrSW50ZXJtZWRpYXRlQ0EuY3J0MAwG
A1UdEwEB/wQCMAAwggOsBggrBgEFBQcBDASCA54wggOaooIDlqCCA5IwggOOMIID
ijCCA4YWDWltYWdlL3N2Zyt4bWwwIzAhMAkGBSsOAwIaBQAEFGckN8uhuoNkcXXh
wRAm7wkz4JRLMIIDThaCA0pkYXRhOmltYWdlL3N2Zyt4bWw7YmFzZTY0LEg0c0lB
QUFBQUFBQUNsMVR5MjdiTUJDODl5c0k5VXlhKytLanNITElJVWlCRnVqSjkxUlJR
cUdLSGNTQ25PYnJ1NVRVQkMwTVNKN2w3SEozZHJRL3o0OW03bC9PdytuWU51Q3dN
YTlQNC9IY05tV2Fuci9zZHBmTHhWM0luVjRlZCtpOTN5bS9NWmZoZmlwdEUySm9U
T21IeHpKdFlCNzZ5L1hwdFcyODhVWWpab24rdkR2M1AxNU9EOFBZdDgwMEhIL2I1
M056dForR2FleXZ2ZzNIWC8zOTErTit0K0w5ODkxVWpITEh0dm5zWTB6WFd1Ryti
YjVMQkJkek5vR2NSTHdGenk1NzdpeWk4eHlzUXdETDNnR2dnZWlZWTBYczJWQjJu
T0ZRODFQb0hBcVltaFBGUUhLRXVSTDBIdk5CbHhBTGgrQlNsazZwb0R3VXJnUU1i
R3QxcVVBazJwVjlBRS9PQitxc0k1S2xwUlN0cG5GSWxSSlo3RWVDZHZQVzdQNmQ5
T2JtWmgwVFdGd01ZakJrNXlHVnBFc0pNbU1BUjVHS1hmRmhPMzU3cWwwbnNFRGVl
Y29kQmcyVFZVblFjSFJBYkJBMHRDTGRpTDQ4OHRrdVVkZzRkbzF1SExzRlY0cjlD
Q3BsMXRJeDZKemVnMFZ4T2RGeUFTODhMMm03WU1sNnl1QkN5bVpycnNUb2N1YVpS
S094YUZhUXV5UTZGNXJ0cGI3UnUxd1N0SXdPcVV2NkZORjRWdFVqR1dGdEp2NUZn
S3p5d3d4TWprUnVXZFFBZEdEZEJqSjIzdXJGVEdvT0liU3FHRUZhNjc0RGJUQkg0
eTBuOVFBWjBqWHE2WVpDckhZNmlGYlI3cXYwa04rVi8zK0RIdXB2WFdLQXJNcWdF
YThWTXBXbytXRkdVcURPVWkxVXh3M3BJR20yUzZ4VXgyU0FlVUc2V2xGVDUvVnN0
S3FkVitlcWtwNHFTTHFnQlJTcmpnRzFTTlRCb0pETE10ZWpHTWEwT0hyNVg3Q3VZ
cXlPaC9WMFhwNjNJWUxTMTl4YUtlZGx0UHFsWDMzNkEwYlJhNW9nQkFBQTCBigYK
KwYBBAHWeQIEAgR8BHoAeAB2AFVZU64wlgCAbNLrUgimyZ6TGCisEFa0QhxVNhVM
X3WsAAABc6DTF3wAAAQDAEcwRQIgRsnN1miYsyCMT234C14MaMgSAgKHXmc7RrBM
a/1ovTMCIQCOc/THDvltzhZrtnoRSbjc2EYp57A0VVHvduQPa7FKBDANBgkqhkiG
9w0BAQsFAAOCAgEA8UQt5jcUeOaDkhvbLq380Oq1Jy8Vr1BO1GPisn20KRCz/NvE
56f8hhmZlZ1xXfOM+JCaGQnwVwcRBQtLQ/+6bmeT8/WM3hf9A5rP0g0ZxvaAlQtu
e6UjvgnNx02QOKNPrmxN0rW8s24kUi0OAf1ump3SY5Ab+S+ywRG7Ah+3qch+FwA8
CYau9TgV5kvfYDRULBM84EeFhsPcwT+YJ5u7RvkGQobqNao21Ti5tupiks/9NzI8
splBS77Z6bPdFGvZ7pJdXiiDB2+SZdyv8iqDFM6mKRbOcuwAHcTY2zVhcS46H7SO
8OU7L/2y0XQB1rMtQDarCKwdAcsAb2e+N8mYQ0glQX4k41Sf4saMXsU1EjnOCUas
YxvVgJRD+fe4JWf8EO59fElzkrQsT3guBIzV5Kg1dYaCHngCYQIakjKQM0eKxZ3d
vn4648A0vXynhJUThOSxN4jbvVA5uYYHqHDMjJtkBPDA7HtLSIxRNattshOAoeC5
LMszAsL9th/WoXkAa2lTs2kashOHEpx+ncGactrL8tu7dvU01Yk6yP1QAjFEo1Nt
8umUG7jQQIuquB2ry4qzFuQvKpbNQZ//9RsSmq1nni+DEKd/S63N7T8M0FpioLVm
Z2OXFTCG5ORjPUOyMGjxzjEPZWmTOG+gqNOc0HKXbuBAsGZbK4dind+YdZE=
-----END CERTIFICATE-----
-----BEGIN CERTIFICATE-----
MIIHLzCCBRegAwIBAgIQDZXVhKBTvJ0ZjW6meNxHhTANBgkqhkiG9w0BAQsFADCB
iDELMAkGA1UEBhMCVVMxDTALBgNVBAgTBFV0YWgxDTALBgNVBAcTBExlaGkxFzAV
BgNVBAoTDkRpZ2lDZXJ0LCBJbmMuMRkwFwYDVQQLExB3d3cuZGlnaWNlcnQuY29t
MScwJQYDVQQDEx5EaWdpQ2VydCBWZXJpZmllZCBNYXJrIFJvb3QgQ0EwHhcNMTkw
OTIzMTIyNTQyWhcNMzQwOTIzMTIyNTQyWjCBkDELMAkGA1UEBhMCVVMxDTALBgNV
BAgTBFV0YWgxDTALBgNVBAcTBExlaGkxFzAVBgNVBAoTDkRpZ2lDZXJ0LCBJbmMu
MRkwFwYDVQQLExB3d3cuZGlnaWNlcnQuY29tMS8wLQYDVQQDEyZEaWdpQ2VydCBW
ZXJpZmllZCBNYXJrIEludGVybWVkaWF0ZSBDQTCCAiIwDQYJKoZIhvcNAQEBBQAD
ggIPADCCAgoCggIBAPfhMd+2RBjNZpqq0GVUF0kKK72fQxhJbnxgYv7GFpmi69sX
dgeqH9RE07ShTDtkLks9G/GuiXsLEmjSCBDDTwfB3hpbdrZsNQFWOIRHXmU8ykuP
bCd/HVRZGULeWvbt93deEB1el5MpxP9Fs3LKjw7xytbuM/nkGJ4D2R1IHC953FoU
4BYsp+8VB1+7Gh8eKVh+HpmBeEfIB+cuq4FpZKxi+F5J7UjW5yO4SuDcTF4AMY0J
DPuKIy+Og6laNOtDS30P1CUu1N6BwLMYTbeqyYHJ7B3kLWsDceGMqIcxo8zrk1rT
sJctcXHXhB4k2PnVxt8qkQjg2Lo++kU0dFSUyrzvg3WrGypv9vphWMI+vmCjmu2K
0BZLZ4nKshoTX495R6pGbsecGaaGgACB/1NcGI7PVp7spY2ytLvHHZ+Hh446BGFy
AdM8lZCMXEhNftP8RRRVr8mwHHzyIa86r4yk0SkOlXUkNrGdTqqyMSDJ3W7DWGO/
vCObzXiM0aq77ebD/0fE5LsZhEJYx7txF9NA1DoICgHp8zqF35i3UOp4+5IyJ8A9
MjqYcX+LayH06B45bMgTHLmJKcsRYvXAtu+nIvIL0fk4+Ea7kJ7MNx5/udS89b2f
vSFC4hmA3OBDiJqGmldwqJL/HP7RI8O54yj10vpiH4obDo8QgfhKSVoX5HwDAgMB
AAGjggGJMIIBhTAdBgNVHQ4EFgQU6w3OZfRSdXtNs9SzPTDjUBir424wHwYDVR0j
BBgwFoAU7G8ipLME4sFjh+Z3Y+pGaU7u/OswDgYDVR0PAQH/BAQDAgGGMBMGA1Ud
JQQMMAoGCCsGAQUFBwMfMBIGA1UdEwEB/wQIMAYBAf8CAQAwfAYIKwYBBQUHAQEE
cDBuMCQGCCsGAQUFBzABhhhodHRwOi8vb2NzcC5kaWdpY2VydC5jb20wRgYIKwYB
BQUHMAKGOmh0dHA6Ly9jYWNlcnRzLmRpZ2ljZXJ0LmNvbS9EaWdpQ2VydFZlcmlm
aWVkTWFya1Jvb3RDQS5jcnQwSAYDVR0fBEEwPzA9oDugOYY3aHR0cDovL2NybDMu
ZGlnaWNlcnQuY29tL0RpZ2lDZXJ0VmVyaWZpZWRNYXJrUm9vdENBLmNybDBCBgNV
HSAEOzA5MDcGCWCGSAGG/WwKATAqMCgGCCsGAQUFBwIBFhxodHRwczovL3d3dy5k
aWdpY2VydC5jb20vQ1BTMA0GCSqGSIb3DQEBCwUAA4ICAQA6v371ixHAA9WyGlFr
+RvmmqkZZg9pf6+j5sKImeTFAHfYz3TJa2wmDRpZxSRYy9VUFOMPVDEavsJ2i5Ua
jEpkJ/7VHbX60joKBxQHKCbMpbwGen6pTXRaeE6CET2zCMbyiIqT2E6OiBZL8cWT
sgLbdhVKspoOi+c3JwTR4khR24J9IQVxK90Nq3zeciYgBvM3G+ZJtZgkA58CRdex
xVO6O57bwe4ti4rlRgWOGgAFpFrJSD1jqhhHD3MWg17NI4k0ciBPoDHHBAI8hiqg
jPM+y6aEGww7BFSfkp5tl/Aq9uGXCwxNLOc3UlUd8Cc0qH1KfkvjrumVMmJhsk9I
88YefbCuGPZ5Q8V2LIz7LrNDh0VRq/HSENXn1sBGlAFahgUTk/cWJ8nKA+8mHMlE
NGmx205Rtbf9lVL1CbH3QFwlvGEfqoMXw6G9JW2hFQVTKpBKuzjQw43CEw12lstP
oa96ixNAXXVGJsdKpYCqTIWJ0x1DssvG2shvzdHxawvYQ3C+/jaEoQ6bxSIdanI2
NMtBdy9Q0TjDc7uf/eaUYKkP4wskNc1Os23oHllFHVm++8wdDltNulc7B1TXIQ+2
oD5EoULMFSVUHX8gtyd463GgOQtBDwf3aZ4Xe6eDrhdfI/4IW098kVcg+qFO841L
qzFkAKWjJj4KjfrbZX4C0Spfxw==
-----END CERTIFICATE-----';

        $x509 = new X509();
        $r = $x509->loadX509($a);

        $this->assertIsArray($r);
    }

    /**
     * @group github1676
     */
    public function testMalformedExt()
    {
        $a = '-----BEGIN CERTIFICATE-----
MIIDtjCCAmmgAwIBAgIUOynecffcNv1/7oqCfu98x899PhwwQgYJKoZIhvcNAQEK
MDWgDTALBglghkgBZQMEAgGhGjAYBgkqhkiG9w0BAQgwCwYJYIZIAWUDBAIBogMC
ASCjAwIBATAcMRowGAYDVQQKDBFwaHBzZWNsaWIgQ0EgY2VydDAeFw0yMTA2MjUw
MTQ1MjlaFw0yMjA2MjUwMTQ1MjlaMBwxGjAYBgNVBAoMEXBocHNlY2xpYiBDQSBj
ZXJ0MIIBVzBCBgkqhkiG9w0BAQowNaANMAsGCWCGSAFlAwQCAaEaMBgGCSqGSIb3
DQEBCDALBglghkgBZQMEAgGiAwIBIKMDAgEBA4IBDwAwggEKAoIBAQCm8w3WEr4t
rbTaAHLI4uAGkZ5mJG8tgThw/qlADPZODjyJtNBZ1i39URXkHa4jdTfLMaCg8aWp
6eouRnNftUktmM4lG3j1JF6Cq2SkF93zJ2RZq3Ldpnv1jXS9qmtsndSzElria6f7
qY3c63S0YFYvNLmMd5lECPYuS3fj0DcPp1Gyy1GnfjSu6OyP34gtjOpZ3bSQmpTg
78HllRZiq6vQIAw6Svoi4Ih573PGRjVHbh/KP5/4gP0ClW+qGjR+qJinmBSOISRU
RSP3Yqh1eSo/gdqOfe+8g7ffTdsZ77xzP2nwq9wsmSyFh/jbQyG05R1cC0zGfBdo
3sDkSw5KDMQzAgMBAAGjUTBPMAsGA1UdDwQEAwIBBjAPBgNVHRMBAf8EBTADAQH/
MB0GA1UdDgQWBBTsxDp1d394JKfAJZOuA9YQSvtvWjAQBggrBgEFBQcBAQEB/wQB
ADBCBgkqhkiG9w0BAQowNaANMAsGCWCGSAFlAwQCAaEaMBgGCSqGSIb3DQEBCDAL
BglghkgBZQMEAgGiAwIBIKMDAgEBA4IBAQCF8DNkkP5z2mkHoo0SvoUpscbaSpXF
jjMpLsQwdhar1jbrEIEQpSGsZlmxpGroBj91wQLjJv7godfFC6b2T4cRcj5NZAEI
ZyoxrfZ0WU609ZAKFooYwEA2nLAG8Y4ygD5adT45MhmqKs79p4uaG5Z78zQrkUYY
d9BtBm0pyZ513s+KW/keUxVKlHnnxdV9FIis0S/d74mjass4YjPZcWnss6TBfIyD
EbQ5UK6Zu74q0lQLp7t14zSQ2B5tclVnM7jY0RiRzpLgDCq3kpbaw6KvFzH9lfPP
BbNA6tFZAwLoX18R6yEmzHAQ+R2Eliiaz7mgQ+M2d0ec6qQJFoO7aJsX
-----END CERTIFICATE-----';

        $x509 = new X509();
        $r = $x509->loadX509($a);

        $this->assertIsArray($r);
    }
}
