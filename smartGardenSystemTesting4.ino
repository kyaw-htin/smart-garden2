//This code does not contain fingerprint senosr

#include<dht.h>
//#include<LiquidCrystal.h>
#include<Keypad.h>
#include<SoftwareSerial.h>
#include<Servo.h>

#define DHT22_PIN D2

dht myDHT;
//LiquidCrystal lcd(12,13,14,15,16,17);

const int EN_A = D6;// for waterpump
const int IN_1 = D3;
const int IN_2 = D4;
const int RED_LED = D7;
const int GREEN_LED = D8;
const int soilSensorPin = A0;
const int waterSensorPin = D0;
int soilValue = 0;
int waterLevel = 0;
float tempValue = 0.0;
float humidValue = 0.0;

struct
{
    uint32_t total;
    uint32_t ok;
    uint32_t crc_error;
    uint32_t time_out;
    uint32_t connect;
    uint32_t ack_l;
    uint32_t ack_h;
    uint32_t unknown;
} stat = { 0,0,0,0,0,0,0,0};

void setup() {
  pinMode(RED_LED, OUTPUT);
  pinMode(GREEN_LED, OUTPUT);
  pinMode(EN_A, OUTPUT);
  pinMode(IN_1, OUTPUT);
  pinMode(IN_2, OUTPUT);
  Serial.begin(9600);
  Serial.println("G-Hackers' Smart Garden System");
  //lcd.begin(20,4);
  //lcd.clear();
  //lcd.setCursor(0,0);
  //lcd.print("Soil Status-");
  //lcd.setCursor(0,1);
  //lcd.print("Water Level-");
  //lcd.setCursor(16,1);
  //lcd.print("cm");
  //lcd.setCursor(0,2);
  //lcd.print("Temperature-");
  //lcd.setCursor(16,2);
  //lcd.print("C");
  //lcd.setCursor(0,3);
  //lcd.print("Humidity-");
  //lcd.setCursor(16,3);
  //lcd.print("%");
}

void loop() {
  smartGardenOperation();
  delay(2000);

}

void smartGardenOperation(){
  soilValue = soilSense();// get the soil value from the soil sensor
  waterLevel = waterLevelCheck();// get water level from the water level sensor
  tempValue = getTemperature();
  humidValue = getHumidity();
  soilCheck(soilValue,waterLevel);// checking sensor values and proceeding other functions
  tempAndHumid(tempValue, humidValue);
  statusLight(waterLevel); //Red LED will on when the water tank is empty otherwise Green LED will on 
  Serial.println();
  Serial.println();
}

int soilSense(){
  int soilSensorValue = analogRead(soilSensorPin);
  int soilOutput = map(soilSensorValue, 0, 1023, 0, 255);
  return soilOutput;
  
}

void soilCheck(int soil_value, float water_level){
  if(soil_value > 150 && water_level > 2.2){
    //lcd.setCursor(12,0);
    //lcd.print("Dry");
    //lcd.setCursor(12,1);
    //lcd.print(water_level);
    Serial.print("Soil Status - Dry , Water Level ");
    Serial.print(water_level);
    Serial.println("cm");
    waterPumpON();
  }else if (soil_value > 150 && water_level <2.2){
    //lcd.setCursor(12,0);
    //lcd.print("Dry");
    //lcd.setCursor(12,1);
    //lcd.print(water_level);
    Serial.print("Soil Status - Dry  Water Level ");
    Serial.print(water_level);
    Serial.println("cm,");
    Serial.println("Water tank is out of water");
    waterPumpOFF();
    //sendingSMS();// sending message to the owner's phone via GSM
  }else if(soil_value < 150){
    //lcd.setCursor(12,0);
    //lcd.print("Wet");
    //lcd.setCursor(12,1);
    //lcd.print(water_level);
    Serial.print("Soil Status - Wet  Water Level ");
    Serial.print(water_level);
    Serial.println("cm");
    waterPumpOFF();
  }
}

float waterLevelCheck(){
  float waterSensorValue = analogRead(waterSensorPin);
  float waterOutput = (waterSensorValue * 4.0) / 580.0;
  return waterOutput;
  
}

void waterPumpON(){
  analogWrite(EN_A, 255);
  digitalWrite(IN_1, HIGH);
  digitalWrite(IN_2, LOW);
}

void waterPumpOFF(){
  analogWrite(EN_A, 0);
  digitalWrite(IN_1, LOW);
  digitalWrite(IN_2, LOW);
}


void statusLight(float water_level){
  if(water_level >2.2){
    digitalWrite(GREEN_LED, HIGH);
    digitalWrite(RED_LED, LOW);
  }else{
    digitalWrite(GREEN_LED, LOW);
    digitalWrite(RED_LED, HIGH);
  }
}

float getTemperature(){
  checkDHT();
  float temp = myDHT.temperature;
  return temp;
}

float getHumidity(){
  checkDHT();
  float humid = myDHT.humidity;
  return humid;
}

void checkDHT(){
  uint32_t start = micros();
  int chk = myDHT.read22(DHT22_PIN);
  uint32_t stop = micros();

    stat.total++;
    switch (chk)
    {
    case 1:
        stat.ok++;
        Serial.print("OK,\t");
        break;
    case 2:
        stat.crc_error++;
        Serial.print("Checksum error,\t");
        break;
    case 3:
        stat.time_out++;
        Serial.print("Time out error,\t");
        break;
    case 4:
        stat.connect++;
        Serial.print("Connect error,\t");
        break;
    case 5:
        stat.ack_l++;
        Serial.print("Ack Low error,\t");
        break;
    case 6:
        stat.ack_h++;
        Serial.print("Ack High error,\t");
        break;
    default:
        stat.unknown++;
        Serial.print("Unknown error,\t");
        break;
    }
}

void tempAndHumid(float t, float h){
  //lcd.setCursor(12,2);
  //lcd.print(t);
  //lcd.setCursor(12,3);
  //lcd.print(h);
  Serial.print("Temperature=");
  Serial.print(t);
  Serial.println("C");
  Serial.print("Humidity=");
  Serial.print(h);
  Serial.println("%");
}

