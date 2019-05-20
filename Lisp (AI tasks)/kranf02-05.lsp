(defun f2 (L)
  (cond
    ((null L) nil)
	((atom (car L))
	  (cond
	    ((symbolp (car L)) (f2 (cdr L)))
		(t (cons (car L) (f2 (cdr L))))))
	(t (cons (car L) (f2 (cdr L))))))

	