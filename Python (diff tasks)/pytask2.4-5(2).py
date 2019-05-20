def fun4(T):
    L = [element for element in T if element < 0]
    return L

T = (2.3, 7, -6.1, 20, 13, -2)
print(fun4(T))