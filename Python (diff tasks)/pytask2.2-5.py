def fun2(L, x):
    R = []
    for element in L:
        if element < 0:
            R.append(x)
            R.append(element)
        else:
            R.append(element)
    return R

L = [-5, 6, 7, 8, 9, 60, -77, 7]
print(fun2(L, 0))