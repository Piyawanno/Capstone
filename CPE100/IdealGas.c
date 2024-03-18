#include <stdio.h>
#include <stdlib.h>
#include <time.h>

#define R 8.134597
#define N 1000

typedef struct IdealGas {
  float pressure;
  float volume;
  float celcius;
  float kelvin;
  float moles;
} IdealGas;

float randomize(float lower, float upper, float precision) {
  int range = (int)((upper - lower) / precision);
  int offset = (int)(lower / precision);
  float result = ((rand() % range) + offset) * precision;
  return result;
}

float toKelvin(float celsius) {
  float kelvin = celsius + 273.15;
  return kelvin;
}

void calculatePresure(IdealGas *gas) {
  gas->pressure = gas->moles * R * gas->kelvin / gas->volume;
}

int main(void) {
  srand(time(NULL));
  float volume;
  printf("volumn:");
  scanf("%f", &volume);
  float moles;
  printf("moles:");
  scanf("%f", &moles);

  IdealGas gas[N];
  for (int i = 0; i < N; i = i + 1) {
    gas[i].volume = volume;
    gas[i].moles = moles;
    gas[i].celcius = randomize(20.0, 40.0, 0.001);
    gas[i].kelvin = toKelvin(gas[i].celcius);
    calculatePresure(&gas[i]);
    printf("presure: %f\n", gas[i].pressure);
  }
  return 0;
}
