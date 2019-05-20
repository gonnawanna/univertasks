;функция разбиения на атомы
(defun split (L)
  (cond
   ((null L) nil)
   ((listp (car L)) (append (split (car L)) (split (cdr L))))
   (t (cons (car L) (split (cdr L))))))

(split '(5 () 4 (3 2) d 1))

;1.Опишите функцию, аргументами которой являются два списка,
;  а результатом - множество, содержащее атомы, принадлежащие
;  только первому списку, учитывая все атомы всех подсписков
;  обоих списков.
(defun f1 (L1 L2)
  (cond
    ((null L1) nil)
	((and (member (car (split (list L1 L2))) (split L1))
	      (not (member (car (split (list L1 L2))) (split L2))))
     (cons (car (split (list L1 L2))) (f1 (cdr L1) L2)))
    (t (f1 (cdr L1) L2))))

(f1 '(r 4 (7) 6 7) '(5 6 7))

;2.Описать функцию, которая находила бы сумму всех числовых
;  атомов в списке, учитывая все атомы подсписков.
(defun f2 (L)
  (cond
    ((null L) 0)
	((numberp (car (split L))) (+ (car (split L)) (f2 (cdr (split L)))))
	(t (f2 (cdr (split L))))))

(f2 '(5 () 4 (3 2) d 1))

;3.Опишите функцию, которая определяет, входят ли атомы первого
;  списка во второй, учитывая все атомы всех подсписков обоих списков.
(defun f3 (L1 L2)
  (cond
  ((null L1) nil)
  ((member (car (split L1)) (split L2)) (cons (car (split L1)) (f3 (cdr L1) L2)))
  (t (f3 (cdr L1) L2))))

(f3 '(r 4 (7) 6 7) '(5 6 7))