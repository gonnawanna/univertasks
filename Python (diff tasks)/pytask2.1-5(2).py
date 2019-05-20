def fun1(L):
    T = [L[i] for i in range(len(L)) if L[i] % (i + 1) == 0]
    return T

L = [-5, 6, 7, 8, 9, 60, -77, 7]
print(fun1(L))