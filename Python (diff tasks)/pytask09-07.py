def s(n):
    a = 1
    b = 1
    for p in range(1, n+1):
        b = b*2
        a += b
    return a
    
n = int(input('n = '))
if n > 0:
    print(s(n))
else:
    print('error')

