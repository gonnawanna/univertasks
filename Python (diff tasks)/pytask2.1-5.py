def fun1(L):
    T = []
    for i in range(len(L)):
        index = i+1
        if L[i] % index == 0:
            T.append(L[i])
    return T

L = [-5, 6, 7, 8, 9, 60, -77, 7]
print(fun1(L))