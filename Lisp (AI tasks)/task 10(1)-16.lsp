(defun elements (L)
  (cond
    ((null L) nil)
    ((listp (car L)) (append (elements (car L)) (elements (cdr L))))
    (t (cons (car L) (elements (cdr L))))))

(defun f (L n)
  (nth (- n 1) (reverse (elements L))))
	
(f '(6 7 8 9 (1 0)) 2)