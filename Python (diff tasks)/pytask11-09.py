def infsum(e):
    i = 1
    s = 0
    a = -1
    while abs(a) >= e:
        s += a
        i += 1
        a /= -(4*(i**2) - 6*i + 2)
    return s

e = float(input('e = '))
if e > 0:
    print(infsum(e))
else:
    print('variable e should be positive')

#a = ((-1)**i)/math.factorial(2*i-1)
#range([start=0], до stop, [step=1])
#0.1
