(defun f3 (L x)
  (cond
    ((null L) nil)
	((atom (car L))
	  (cond
	    ((> (car L) 0) (cons (* (car L) x) (f3 (cdr L) x)))
		((< (car L) 0) (cons '0 (f3 (cdr L) x)))
		(t (cons (car L) (f3 (cdr L) x)))))
	(t (append (f3 (car L) x) (f3 (cdr L) x)))))
	
(f3 '(2 1 -3 (7) (-1 2) 0) 2)