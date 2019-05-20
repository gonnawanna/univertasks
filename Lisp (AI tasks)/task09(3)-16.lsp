(defun f3 (L n)
  (cond
    ((null L) nil)
    ((equal (length L) n) (car L))
    (t (f3 (cdr L) n))))
	
 (f3 '(6 7 8 9 (1 0)) 2)