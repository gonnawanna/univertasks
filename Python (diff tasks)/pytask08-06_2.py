def f(x):
    c = (x + 1)**2
    if c < 2:
        y = x**2
    elif c < 3:
        y = 1/(x**2 -1)
    else:
        y = 0
    return y
    
a = float(input('a = '))
b = float(input('b = '))
h = float(input('h = '))
if a < b:
    x = a
    while x <= b:
        print('x =', round(x, 2), '---> y =', round(f(x), 2))
        x = x + h
else:
    print('Invalid range')

# -3 2 0.5
