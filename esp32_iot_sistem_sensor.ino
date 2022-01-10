// include library wifi
#include <WiFi.h>

// request HTTP client
#include <HTTPClient.h>

// request DHT 11
#include "DHT.h"

// include arduino json
#include <Arduino_JSON.h>

const char *ssid = "iPhone";
const char *password = "manaembuy";
const char *serverRequest = "http://192.168.1.7/BackendRestSistemSensor/public/api/data_perintah";

String DataRead;
int DataReadArr[5];

// deklarasi Pin LED (lampu kamar) menggunakan array
int teras[3] = {4, 5, 19};
int kamar[2] = {18, 12};
// server POST sensor
const char *serverPost = "http://192.168.1.7/BackendRestSistemSensor/public/api/sistem_sensor";

// deklarasi pin sensor DHT 11(sensor suhu)
#define DHTPIN 2

// type sensor suhu
#define DHTTYPE DHT11

// inisialisasi variable pin sensor suhunya
DHT dht(DHTPIN, DHTTYPE);

// inisialisasi variable untuk menyimpan fungsi client
WiFiClient client;
HTTPClient http;

// deklarasi variable BUZZER
const int buzzer = 27;
const int infrared_IR = 25;
int data_obstacle;

void setup()
{
    /* SETUP SERIAL BEGIN*/
    Serial.begin(115200);
    /* END */

    /* SETUP SENSOR SUHU(DHT) */
    Serial.println(F("DHTxx test!"));
    dht.begin();
    /* END */

    /* SETUP PIN LED */
    for (int a = 0; a <= 2; a++)
    {
        pinMode(teras[a], OUTPUT);
        digitalWrite(teras[a], LOW);
    }
    for (int b = 0; b <= 1; b++)
    {
        pinMode(kamar[b], OUTPUT);
        digitalWrite(kamar[b], LOW);
    }
    /*END */

    /** SETUP BUZZERi **/
    pinMode(buzzer, OUTPUT);
    /** END **/

    /** SETUP SENSOR OBSTACLE IR **/
    pinMode(infrared_IR, INPUT);
    /** END **/
    /** SETUP WIFI **/
    pinMode(LED_BUILTIN, OUTPUT);
    delay(1000);
    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED)
    {
        delay(500);
        Serial.println("Connecting Wifi...");
    }
    Serial.println("WiFi berhasil Konek");
    /** END **/
}
void loop()
{
    /* LOGIC PROGRAM SENSOR SUHU DHT 11 **/
    // read suhu
    float t = dht.readTemperature();
    if (isnan(t))
    {
        Serial.println(F("Failed to read from DHT sensor!"));
        return;
    }
    /** END **/
    // deteksi orang yang mau masuk kedalam teras
    data_obstacle = digitalRead(infrared_IR);

    if (data_obstacle != HIGH)
    {
        digitalWrite(buzzer, HIGH);
    }
    else
    {
        digitalWrite(buzzer, LOW);
    }

    jalankan_request_data(serverRequest, t);
}

void jalankan_request_data(const char *serverRequest, float t)
{
    if (WiFi.status() == WL_CONNECTED)
    {
        DataRead = httpGETRequest(serverRequest);
        Serial.println(DataRead);
        JSONVar myObject = JSON.parse(DataRead);

        if (JSON.typeof(DataRead) == "undefined")
        {
            Serial.println("parsing input failed");
            return;
        }
        JSONVar keys = myObject.keys();

        for (int i = 0; i < keys.length(); i++)
        {
            JSONVar value = myObject[keys[i]];
            // menyimpan request data dari web server ke dalam arrayData
            DataReadArr[i] = int(value);
        }
        // logic LED dan sensor suhu
        // lampu ruang tamu
        if (DataReadArr[1] == 1)
        {
            digitalWrite(kamar[0], HIGH);
        }
        else
        {
            digitalWrite(kamar[0], LOW);
        }

        // lampu kamar tidur
        if (DataReadArr[2] == 1)
        {
            digitalWrite(kamar[1], HIGH);
        }
        else
        {
            digitalWrite(kamar[1], LOW);
        }

        // lampu teras
        if (DataReadArr[4] == 1)
        {
            for (int a = 0; a <= 2; a++)
            {
                digitalWrite(teras[a], HIGH);
            }
        }
        else
        {
            for (int a = 0; a <= 2; a++)
            {
                digitalWrite(teras[a], LOW);
            }
        }
        // baca data suhu
        Serial.print(F("%  Temperature: "));
        Serial.print(t);
        Serial.print(F("°C "));

        float sensor_suhu = t; // mengirim nilai suhu dalam satuan derajat celcius
        kirim_sensor(serverPost, sensor_suhu);
    }
    else
    {
        Serial.println('WiFi tidak terhubung');
    }
    delay(2000);
}

void kirim_sensor(const char *serverPost, float sensor_suhu)
{
    String path_name = "/suhu/";
    int id = 1;
    String path_name_2 = "/";
    float sensor = sensor_suhu;
    http.begin(serverPost + path_name + id + path_name_2 + sensor);
    // jalankan method
    http.GET();
    http.end();
}

String httpGETRequest(const char *serverRequest)
{

    // Your Domain name with URL path or IP address with path
    http.begin(client, serverRequest);

    // Send HTTP POST request
    int httpResponseCode = http.GET();

    String payload = "{}";

    if (httpResponseCode > 0)
    {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        payload = http.getString();
    }
    else
    {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
    }
    // Free resources
    http.end();

    return payload;
}