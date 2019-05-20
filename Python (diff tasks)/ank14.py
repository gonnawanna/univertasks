def f14(c, s, s0): # аргументы: символ, строка, другая строка
    # в питоне нельзя вставлять символы в уже существующую строку, можно только соединять строки
    new = '' # создаем новую пустую строку
    for symbol in s: # для каждого элемента исходной строки
        new += symbol # добавляем этот элемент к строке new
        if symbol == c: # если этот элемент совпадает с заданным символом
            new += s0 # то добавляем заданную строку к new
    return new # результат функции - новая строка

print(f14('u', 'pazuzu', '.'))