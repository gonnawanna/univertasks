x = float(input('Введите x-координату точки: '))
y = float(input('Введите y-координату точки: '))

a = 0
b = 0

c = (x - a)**2 + (y - b)**2 - 9**2

if 0 < x <= 9 and -9 <= y <= 9:
    if c == 0:
        print('На границе')
    elif c < 0:
        print('Да')
    else:
        print('Нет')
else:
    print('Нет')
