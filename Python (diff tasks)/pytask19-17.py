def change(message):
    array = message.split(' ')
    n = len(array)
    print(n)
    s = ''
    if n % 2 == 0:
        s += reverse(array)
    else:
        s += reverse(array[:n-1])
        s += array[n-1]
    return s

def reverse(array):
    s = ''
    n = len(array)
    for i in range(n // 2, n):
        s += array[i] + ' '
    for i in range(n // 2):
        s += array[i] + ' '
    return s

message = 'Фантастические твари и как они сдают сессию, ни разу не появившись на парах.'
print(change(message))