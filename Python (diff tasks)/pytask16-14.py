def sumnum(x):
    s = 0
    while x != 0:
        s += x%10
        x //= 10
    return s

def fun(a, b, s):
    R = []
    for x in range(a, b+1):
        if sumnum(x) == s:
            R.append(x)
    return R

a = int(input("a = "))
b = int(input("b = "))
s = int(input("s = "))
print(fun(a, b, s))