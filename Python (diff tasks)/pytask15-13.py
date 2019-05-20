def fun(x):
    a = x
    n = 0
    while a != 0:
        n += 1
        a //= 10
    if n == 3:
        y = x%10*100 + x%100//10*10 + x//100
    else:
        y = x
    return y

x = int(input('x = '))
print(fun(x))