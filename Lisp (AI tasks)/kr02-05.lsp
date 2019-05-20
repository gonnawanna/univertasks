(defun f2 (L x)
  (cond
    ((null L) nil)
	((numberp (car L))
	  (cond
	    ((> (car L) 0) (cons (* (car L) x) (f2 (cdr L) x)))
		((< (car L) 0) (cons 0 (f2 (cdr L) x)))
		(t (cons (car L) (f2 (cdr L) x)))))
	(t (cons (car L) (f2 (cdr L) x)))))
	
(f2 '(2 1 -3 (7) 0) 2)