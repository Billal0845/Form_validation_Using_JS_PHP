#include<stdio.h>
#include<stdlib.h>
int empty = 10;
int mutex = 1;
int full = 0;
int item = 0;

void producer(){
  --mutex;
  ++full;
  --empty;
  item++;
  printf("Producer produces %d item", item);
  ++mutex;

}

void consumer(){
  --mutex;
  --full;
  ++empty;
  item--;
  printf("consumer consumed %d item", item);
  ++mutex;

}


int main(){

  int i,choice;
  printf("\n1. Press 1 for Producer"
           "\n2. Press 2 for Consumer"
           "\n3. Press 3 for Exit");

  for(i=1; i>0; i++){
    printf("\nEnter your choice:");
        scanf("%d", &choice);

    switch (choice)
    {
      case 1:
          if((mutex == 1) && (empty!=0)){
            producer();
          }else{
            printf("Buffer is full!");
          }
          break;

      case 2:
          if((mutex==1) && (full !=0)){
            consumer();
          }else{
            printf("Buffer is empty!");
          }
          break;
      case 3:
            exit(0);
            break;
    }
  }

}