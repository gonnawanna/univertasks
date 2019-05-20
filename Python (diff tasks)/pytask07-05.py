import math

a = float(input('a = '))
b = float(input('b = '))
h = float(input('h = '))

if a < b:
    x = a
    while x <= b:
        s = x-1
        if s > 0:
            y = math.log(s)
            print('x =',round(x,2),'==> y =',y)
        else:
            print('В точке',x,'функция не определена')
        x = x + h
else:
    print('Введите корректный диапазон')
