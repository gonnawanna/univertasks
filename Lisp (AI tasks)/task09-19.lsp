﻿;1.Описать функцию, которая старый элемент заменяет на новый.
(defun f1 (L A1 A2)
  (cond
    ((null L) nil)
    ((equal (car L) A1) (cons A2 (f1 (cdr L) A1 A2)))
    (t (cons (car L) (f1 (cdr L) A1 A2)))))

(f1 '(5 4 (5) 52 5 7) 5 1)
(f1 '(() g (4) 8 ()) '() '(1 1))
(f1 '(f o o) 'a 'b) 

;2.Описать функцию, которая создавала бы список 
;  только из числовых элементов списка-аргумента.
(defun f2 (L)
  (cond
    ((null L) nil)
	((numberp (car L)) (cons (car L) (f2 (cdr L)))) 
    (t (f2 (cdr L)))))
	
(f2 '(s 3 () -75 v 140))
(f2 '(f o o (5)))

;3.Определите сколько раз в списке встречается заданный элемент.
(defun f3 (L A)
  (cond
    ((null L) 0)
	((equal (car L) A) (+ (f3 (cdr L) A) 1))
	(t (f3 (cdr L) A))))
	
(f3 '(0 1 2 3 1 2 3 2 3) 2)
(f3 '(1 2 3) 4)
(f3 '(1 2 3 4 (4)) '(4))
(f3 '(j 7 j7) 'j)